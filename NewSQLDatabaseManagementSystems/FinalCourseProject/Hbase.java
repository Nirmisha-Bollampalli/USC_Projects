package HBase;

import java.io.BufferedInputStream;
import java.io.ByteArrayInputStream;
import java.io.DataInputStream;
import java.io.File;
import java.io.FileInputStream;
import java.io.FileOutputStream;
import java.io.IOException;
import java.io.InputStream;
import java.sql.Blob;
import java.sql.ResultSet;
import java.sql.ResultSetMetaData;
import java.sql.SQLException;
import java.util.*;

import org.apache.hadoop.conf.Configuration;
import org.apache.hadoop.hbase.HBaseConfiguration;
import org.apache.hadoop.hbase.HColumnDescriptor;
import org.apache.hadoop.hbase.HTableDescriptor;
import org.apache.hadoop.hbase.KeyValue;
import org.apache.hadoop.hbase.client.*;

import org.apache.hadoop.hbase.rest.protobuf.generated.CellSetMessage.CellSet.Row;
import org.apache.hadoop.hbase.util.Bytes;
import org.apache.commons.lang.StringUtils;

import edu.usc.bg.base.ByteIterator;
import edu.usc.bg.base.DB;
import edu.usc.bg.base.DBException;
import edu.usc.bg.base.ObjectByteIterator;



public class Hbase extends DB{

    public static final int SUCCESS = 0;
    private static Configuration conf = null;
    private boolean initialized = false;
    private HTablePool hTablePool;
    private static String FSimagePath = "";

    private boolean StoreImageInFS(String userid, byte[] image, boolean profileimg){
        boolean result = true;
        String ext = "thumbnail";

        if (profileimg) ext = "profile";

        String ImageFileName = FSimagePath+"\\img"+userid+ext;

        File tgt = new File(ImageFileName);
        if ( tgt.exists() ){
            if (! tgt.delete() ) {
                System.out.println("Error, file exists and failed to delete");
                return false;
            }
        }

        //Write the file
        try{
            FileOutputStream fos = new FileOutputStream(ImageFileName);
            fos.write(image);
            fos.close();
        }catch(Exception ex){
            System.out.println("Error in writing the file"+ImageFileName);
            ex.printStackTrace(System.out);
        }

        return result;
    }

    private byte[] GetImageFromFS(String userid, boolean profileimg){
        int filelength = 0;
        String ext = "thumbnail";
        byte[] imgpayload = null;
        BufferedInputStream bis = null;

        if (profileimg) ext = "profile";

        String ImageFileName = FSimagePath+"\\img"+userid+ext;
        int attempt = 100;
        while(attempt>0){
            try {
                FileInputStream fis = null;
                DataInputStream dis = null;
                File fsimage = new File(ImageFileName); 
                filelength = (int) fsimage.length();
                imgpayload = new byte[filelength];
                fis = new FileInputStream(fsimage);
                dis = new DataInputStream(fis);
                int read = 0;
                int numRead = 0;
                while (read < filelength && (numRead=dis.read(imgpayload, read, filelength - read    ) ) >= 0) {
                    read = read + numRead;
                }
                dis.close();
                fis.close();
                break;
            } catch (Exception e) {
                e.printStackTrace(System.out);
                attempt--;
            }
        }
        return imgpayload;
    }

    /**
     * Initialize the database connection and set it up for sending requests to the database.
     * This must be called once per client.
     * 
     */
    @Override
    public boolean init() throws DBException {
        if (initialized) {
            System.out.println("Client connection already initialized.");
            return true;
        }

        try{
            conf = HBaseConfiguration.create();
            conf.setInt("hbase.zookeeper.property.clientPort", 2181);
            conf.set("hbase.regionserver.port","60020");
            hTablePool = new HTablePool(conf, 10000000);

        }
        catch(Exception e){
            e.printStackTrace();
            return false;
        }

        initialized = true;
        return true;
    }


    @Override
    //Load phase query not cached
    public int insertEntity(String entitySet, String entityPK, HashMap<String, ByteIterator> values, boolean insertImage) {

        if (entitySet == null) {
            return -1;
        }
        if (entityPK == null) {
            return -1;
        }
        //    System.out.println("Im in InsertEntity");
        try {

            if(entitySet.equalsIgnoreCase("users") && insertImage){
                //System.out.println("Im in users entity insert image");

                HTableInterface table;
                table = hTablePool.getTable(entitySet);


                Put put = new Put(Bytes.toBytes(entityPK));        

                for (Map.Entry<String, ByteIterator> entry : values.entrySet()) {

                    if(entry.getKey().equalsIgnoreCase("pic")){

                        byte[] profileImage = ((ObjectByteIterator)values.get("pic")).toArray();

                        if ( FSimagePath.equals("") )
                            put.add(Bytes.toBytes("users"), Bytes.toBytes("pic"),profileImage);                    
                        else
                            StoreImageInFS(entityPK, profileImage, true);

                        table.put(put);

                    }
                    else if(entry.getKey().equalsIgnoreCase("tpic") ){

                        byte[] thumbImage = ((ObjectByteIterator)values.get("tpic")).toArray();

                        if (FSimagePath.equals(""))
                            put.add(Bytes.toBytes("users"), Bytes.toBytes("tpic"), thumbImage);    
                        else
                            StoreImageInFS(entityPK, thumbImage, false);

                        table.put(put);

                    }
                    else{

                        String field = entry.getValue().toString();
                        put.add(Bytes.toBytes("users"), Bytes.toBytes(entry.getKey().toString()), Bytes
                                .toBytes(field));
                        table.put(put);
                    }

                }


                Put put1 = new Put(Bytes.toBytes(entityPK));    
                put1.add(Bytes.toBytes("stats"), Bytes.toBytes("penfriends"), Bytes
                        .toBytes("0"));
                put1.add(Bytes.toBytes("stats"), Bytes.toBytes("confriends"), Bytes
                        .toBytes("0"));
                put1.add(Bytes.toBytes("stats"), Bytes.toBytes("numresources"), Bytes
                        .toBytes("0"));
                table.put(put1);
                table.close();
                hTablePool.putTable(table);



            }
            else if(entitySet.equalsIgnoreCase("users")){


                HTableInterface table;
                table = hTablePool.getTable(entitySet);

                Put put = new Put(Bytes.toBytes(entityPK));        

                for (Map.Entry<String, ByteIterator> entry : values.entrySet()) {

                    String field = entry.getValue().toString();
                    put.add(Bytes.toBytes("users"), Bytes.toBytes(entry.getKey().toString()), Bytes
                            .toBytes(field));
                    table.put(put);

                }


                Put put1 = new Put(Bytes.toBytes(entityPK));    
                put1.add(Bytes.toBytes("stats"), Bytes.toBytes("penfriends"), Bytes
                        .toBytes("0"));
                put1.add(Bytes.toBytes("stats"), Bytes.toBytes("confriends"), Bytes
                        .toBytes("0"));
                put1.add(Bytes.toBytes("stats"), Bytes.toBytes("numresources"), Bytes
                        .toBytes("0"));
                table.put(put1);
                table.close();
                hTablePool.putTable(table);


            }
            if(entitySet.equalsIgnoreCase("resources")){


                boolean flag = false;
                String PK="";

                String temprid = entityPK.toString();
                int field;

                for (Map.Entry<String, ByteIterator> entry2 : values.entrySet()) 
                {                    
                    //System.out.println((entry2.getKey().toString()));
                    if((entry2.getKey().toString().equals("creatorid")))
                    {                    
                        String field1 = entry2.getValue().toString();
                        field = Integer.parseInt(field1);
                        PK+=field;
                        flag = true;
                    }
                }

                if(flag == true){

                    HTableInterface table;
                    table = hTablePool.getTable("users");

                    Put put = new Put(Bytes.toBytes(PK));
                    for (Map.Entry<String, ByteIterator> entry1 : values.entrySet()) {

                        if(entry1.getKey().toString() != "creatorid")
                        {
                            String field1 = entry1.getValue().toString();
                            String field2 = entry1.getKey().toString()+"_"+temprid;
                            put.add(Bytes.toBytes("resources"), Bytes.toBytes(field2), Bytes
                                    .toBytes(field1));

                        }
                    }

                    table.put(put);
                    Get get = new  Get(PK.getBytes());
                    Result rs = table.get(get);
                    for(KeyValue kv : rs.raw()){
                        if((new String(kv.getQualifier())).equals("numresources"))
                        {
                            int numresources=Integer.parseInt(new String(kv.getValue()));
                            //System.out.println("numresources !!!  "+numresources);
                            numresources+=1;
                            put.add(Bytes.toBytes("stats"), Bytes.toBytes("numresources"), Bytes
                                    .toBytes(numresources+""));
                        }
                    }
                    table.put(put);
                    table.close();
                    hTablePool.putTable(table);

                }

            } 

        }catch(Exception e){}    

        return 0;

    }
    @Override
    public int viewProfile(int requesterID, int profileOwnerID,
            HashMap<String, ByteIterator> result, boolean insertImage,
            boolean testMode) {
        try {

            HTableInterface table;
            table = hTablePool.getTable("users");

            String rowKey = profileOwnerID+"";
            String inviterID;

            Get get = new Get(rowKey.getBytes());
            Result rs = table.get(get);
            Result rs2 = table.get(get);

            for(KeyValue kv : rs.raw()){

                String qual_name = new String(kv.getQualifier());
                String fam_name = new String(kv.getFamily());
                String value = new String(kv.getValue());

                if(qual_name.equals("confriends"))
                {
                    result.put("friendcount", new ObjectByteIterator(value.getBytes())) ;
                }
                if(qual_name.equals("penfriends") && requesterID==profileOwnerID)
                {
                    result.put("pendingcount", new ObjectByteIterator(value.getBytes())) ;
                }
                if(qual_name.equals("numresources"))
                {
                    result.put("resourcecount", new ObjectByteIterator(value.getBytes())) ;
                }

                if(fam_name.equals("users")){
                    result.put("userid", new ObjectByteIterator(rowKey.getBytes())) ;
                    for(KeyValue kv2 : rs2.raw()){
                        String quall_name = new String(kv2.getQualifier());
                        String valuee = new String(kv2.getValue());
                        
                        if(quall_name.equals("username"))
                            result.put("username", new ObjectByteIterator(valuee.getBytes())) ;
                        else if(quall_name.equals("fname"))
                            result.put("fname", new ObjectByteIterator(valuee.getBytes())) ;
                        else if(quall_name.equals("lname"))
                            result.put("lname", new ObjectByteIterator(valuee.getBytes())) ;
                        else if(quall_name.equals("gender"))
                            result.put("gender", new ObjectByteIterator(valuee.getBytes())) ;
                        else if(quall_name.equals("dob"))
                            result.put("dob", new ObjectByteIterator(valuee.getBytes())) ;
                        else if(quall_name.equals("jdate"))
                            result.put("jdate", new ObjectByteIterator(valuee.getBytes())) ;
                        else if(quall_name.equals("ldate"))
                            result.put("ldate", new ObjectByteIterator(valuee.getBytes())) ;
                        else if(quall_name.equals("address"))
                            result.put("address", new ObjectByteIterator(valuee.getBytes())) ;
                        else if(quall_name.equals("email"))
                            result.put("email", new ObjectByteIterator(valuee.getBytes())) ;
                        else if(quall_name.equals("tel"))
                            result.put("tel", new ObjectByteIterator(valuee.getBytes())) ;
                        else if(quall_name.equals("pic") && insertImage)
                            result.put("pic", new ObjectByteIterator(valuee.getBytes())) ;
                    }

                }

            }    
            table.close();
            hTablePool.putTable(table);

        }

        catch(Exception e){
            e.printStackTrace();
            return -2;
        }  
        return 0;
    }


    @Override
    public int listFriends(int requesterID, int profileOwnerID,
            Set<String> fields, Vector<HashMap<String, ByteIterator>> results,
            boolean insertImage, boolean testMode) {

        try {

            HTableInterface table;
            table = hTablePool.getTable("users");

            String rowKey = profileOwnerID+"";
            String inviterID;
            Get get = new Get(rowKey.getBytes());
            Result rs = table.get(get);
            Result rs2 = table.get(get);
            
            for(KeyValue kv : rs.raw()){
                String fam_name = new String(kv.getQualifier());
                String value = new String(kv.getValue());

                if((fam_name.contains("status"))&&(value.equals("2")))
                {
                    HashMap<String, ByteIterator> result = new HashMap<String, ByteIterator>();
                    result.put("userid", new ObjectByteIterator(rowKey.getBytes())) ;
                    
                    for(KeyValue kv2 : rs2.raw()){
                        String quall_name = new String(kv2.getQualifier());
                        String valuee = new String(kv2.getValue());
                        
                        if(quall_name.equals("username"))
                            result.put("username", new ObjectByteIterator(valuee.getBytes())) ;
                        else if(quall_name.equals("fname"))
                            result.put("fname", new ObjectByteIterator(valuee.getBytes())) ;
                        else if(quall_name.equals("lname"))
                            result.put("lname", new ObjectByteIterator(valuee.getBytes())) ;
                        else if(quall_name.equals("gender"))
                            result.put("gender", new ObjectByteIterator(valuee.getBytes())) ;
                        else if(quall_name.equals("dob"))
                            result.put("dob", new ObjectByteIterator(valuee.getBytes())) ;
                        else if(quall_name.equals("jdate"))
                            result.put("jdate", new ObjectByteIterator(valuee.getBytes())) ;
                        else if(quall_name.equals("ldate"))
                            result.put("ldate", new ObjectByteIterator(valuee.getBytes())) ;
                        else if(quall_name.equals("address"))
                            result.put("address", new ObjectByteIterator(valuee.getBytes())) ;
                        else if(quall_name.equals("email"))
                            result.put("email", new ObjectByteIterator(valuee.getBytes())) ;
                        else if(quall_name.equals("tel"))
                            result.put("tel", new ObjectByteIterator(valuee.getBytes())) ;
                        else if(quall_name.equals("pic") && insertImage)
                            result.put("pic", new ObjectByteIterator(valuee.getBytes())) ;
                    }    
                    
                    results.add(result);
                }

            }
            
            table.close();
            hTablePool.putTable(table);


        }
        catch(Exception e){
            e.printStackTrace();
            return -2;
        }   
        return 0;
    }


    @Override
    public int viewFriendReq(int profileOwnerID,
            Vector<HashMap<String, ByteIterator>> results, boolean insertImage,
            boolean testMode) {
        // TODO Auto-generated method stub
        try {

            HTableInterface table;
            table = hTablePool.getTable("users");

            String rowKey = profileOwnerID+"";
            String inviterID;
            Get get = new Get(rowKey.getBytes());
            Result rs = table.get(get);
            Result rs2 = table.get(get);
            
            for(KeyValue kv : rs.raw()){
                String fam_name = new String(kv.getQualifier());
                String value = new String(kv.getValue());

                if((fam_name.contains("status"))&&(value.equals("1")))
                {
                    HashMap<String, ByteIterator> result = new HashMap<String, ByteIterator>();
                    result.put("userid", new ObjectByteIterator(rowKey.getBytes())) ;
                    
                    for(KeyValue kv2 : rs2.raw()){
                        String quall_name = new String(kv2.getQualifier());
                        String valuee = new String(kv2.getValue());
                        
                        if(quall_name.equals("username"))
                            result.put("username", new ObjectByteIterator(valuee.getBytes())) ;
                        else if(quall_name.equals("fname"))
                            result.put("fname", new ObjectByteIterator(valuee.getBytes())) ;
                        else if(quall_name.equals("lname"))
                            result.put("lname", new ObjectByteIterator(valuee.getBytes())) ;
                        else if(quall_name.equals("gender"))
                            result.put("gender", new ObjectByteIterator(valuee.getBytes())) ;
                        else if(quall_name.equals("dob"))
                            result.put("dob", new ObjectByteIterator(valuee.getBytes())) ;
                        else if(quall_name.equals("jdate"))
                            result.put("jdate", new ObjectByteIterator(valuee.getBytes())) ;
                        else if(quall_name.equals("ldate"))
                            result.put("ldate", new ObjectByteIterator(valuee.getBytes())) ;
                        else if(quall_name.equals("address"))
                            result.put("address", new ObjectByteIterator(valuee.getBytes())) ;
                        else if(quall_name.equals("email"))
                            result.put("email", new ObjectByteIterator(valuee.getBytes())) ;
                        else if(quall_name.equals("tel"))
                            result.put("tel", new ObjectByteIterator(valuee.getBytes())) ;
                        else if(quall_name.equals("pic") && insertImage)
                            result.put("pic", new ObjectByteIterator(valuee.getBytes())) ;
                    }    
                    
                    results.add(result);

                }

            }
            table.close();
            hTablePool.putTable(table);


        }
        catch(Exception e){
            e.printStackTrace();
            return -2;
        }   
        return 0;
    }

    @Override
    public int acceptFriend(int inviterID, int inviteeID) {
        //    System.out.println("Accept Called");
        if(inviterID < 0 || inviteeID < 0)
        {
            return -1;
        }
        try
        {

            HTableInterface table;
            table = hTablePool.getTable("users");
            String PK = "";
            PK += inviterID;
            Put put = new Put(Bytes.toBytes(PK));
            String colname= "friend_"+inviteeID;
            put.add(Bytes.toBytes("friends"), Bytes.toBytes(colname), Bytes
                    .toBytes(inviteeID));
            String statname="status_"+inviteeID;
            put.add(Bytes.toBytes("friends"), Bytes.toBytes(statname), Bytes
                    .toBytes("2"));
            table.put(put);
            Get get = new  Get(PK.getBytes());
            Result rs = table.get(get);
            for(KeyValue kv : rs.raw()){
                if((new String(kv.getQualifier())).equals("confriends"))
                {
                    int confriends=Integer.parseInt(new String(kv.getValue()));
                    confriends+=1;
                    put.add(Bytes.toBytes("stats"), Bytes.toBytes("confriends"), Bytes
                            .toBytes(confriends+""));
                }
            }
            table.put(put);
            //change status of inviteeID entry in table
            PK = "";
            PK += inviteeID;
            Put put2 = new Put(Bytes.toBytes(PK));
            statname="status_"+inviterID;
            put2.add(Bytes.toBytes("friends"), Bytes.toBytes(statname), Bytes
                    .toBytes("2"));
            table.put(put2);
            get = new  Get(PK.getBytes());
            rs = table.get(get);

            for(KeyValue kv : rs.raw()){
                if((new String(kv.getQualifier())).equals("confriends"))
                {
                    int confriends=Integer.parseInt(new String(kv.getValue()));
                    confriends+=1;
                    put2.add(Bytes.toBytes("stats"), Bytes.toBytes("confriends"), Bytes
                            .toBytes(confriends+""));
                }
                if((new String(kv.getQualifier())).equals("penfriends"))
                {
                    int penfriends=Integer.parseInt(new String(kv.getValue()));
                    //        if(penfriends>0)
                    {

                        penfriends-=1;
                        put2.add(Bytes.toBytes("stats"), Bytes.toBytes("penfriends"), Bytes
                                .toBytes(penfriends+""));
                    }
                }
            }
            table.put(put2);
            table.close();
            hTablePool.putTable(table);

        }
        catch (Exception e)
        {
            e.printStackTrace();
            return -2;
        }
        return 0;
    }


    @Override
    public int rejectFriend(int inviterID, int inviteeID) {
        //System.out.println("Reject Called");
        if(inviterID < 0 || inviteeID < 0)
        {
            return -1;
        }
        try
        {

            HTableInterface table;
            table = hTablePool.getTable("users");

            String rowKey = ""+inviteeID;
            Put put = new Put(Bytes.toBytes(rowKey));
            Delete delete = new Delete(rowKey.getBytes());
            delete.deleteColumns(Bytes.toBytes("friends"), Bytes.toBytes("friend_"+inviterID));
            delete.deleteColumns(Bytes.toBytes("friends"), Bytes.toBytes("status_"+inviterID));
            table.delete(delete);
            Get get = new  Get(rowKey.getBytes());
            Result rs = table.get(get);
            for(KeyValue kv : rs.raw()){
                if((new String(kv.getQualifier())).equals("penfriends"))
                {
                    int penfriends=Integer.parseInt(new String(kv.getValue()));

                    penfriends-=1;
                    put.add(Bytes.toBytes("stats"), Bytes.toBytes("penfriends"), Bytes
                            .toBytes(penfriends+""));

                }
            }
            table.put(put);
            table.close();
            hTablePool.putTable(table);

        }
        catch (IOException e) {
            e.printStackTrace();
            return -2;
        }
        return 0;
    }


    @Override
    public int inviteFriend(int inviterID, int inviteeID) {
        //    System.out.println("Invite Called");
        if(inviterID < 0 || inviteeID < 0)
        {
            return -1;
        }
        try {

            HTableInterface table;
            table = hTablePool.getTable("users");
            String PK = "";
            PK += inviteeID;
            Put put = new Put(Bytes.toBytes(PK));
            String colname= "friend_"+inviterID;
            put.add(Bytes.toBytes("friends"), Bytes.toBytes(colname), Bytes
                    .toBytes(inviterID));
            String statname="status_"+inviterID;
            put.add(Bytes.toBytes("friends"), Bytes.toBytes(statname), Bytes
                    .toBytes("1"));
            //System.out.println("added friends");
            table.put(put);
            Get get = new  Get(PK.getBytes());
            Result rs = table.get(get);
            for(KeyValue kv : rs.raw()){
                if((new String(kv.getQualifier())).equals("penfriends"))
                {
                    int penfriends=Integer.parseInt(new String(kv.getValue()));
                    penfriends+=1;
                    put.add(Bytes.toBytes("stats"), Bytes.toBytes("penfriends"), Bytes
                            .toBytes(penfriends+""));
                }
            }
            table.put(put);
            table.close();
            hTablePool.putTable(table);


        } catch (IOException e) {
            e.printStackTrace();
            return -2;
        }

        return 0;
    }


    @Override
    public int viewTopKResources(int requesterID, int profileOwnerID, int k,Vector<HashMap<String, ByteIterator>> result) {

        HTableInterface table;
        try {

            table = hTablePool.getTable("users");
            String rowKey = ""+profileOwnerID;
            Get get = new Get(rowKey.getBytes());
            Result rs = table.get(get);
            Result rs2 = table.get(get);

            //System.out.println("RowKey"+rowKey);
            HashMap<String,String> RIDvalues = new HashMap<String,String>();
            int RIDs = 0;
            for(KeyValue kv : rs.raw()){
                if(RIDs < k){
                    if(new String(kv.getFamily()).equals("resources")){
                        //System.out.println("Family"+new String(kv.getFamily()));
                        if(new String(kv.getQualifier()).contains("rid")){
                            //System.out.println("Qualifier"+new String(kv.getQualifier()));

                            int index = new String(kv.getQualifier()).lastIndexOf("_");
                            String mid = new String(kv.getQualifier()).substring(index+1);
                            int Mid = Integer.parseInt(mid);
                            //System.out.println("MID"+ Mid);

                            String val = new String(kv.getValue());
                            //System.out.println("Val"+ val);
                            String timestamp = new String(kv.getTimestamp()+"");
                            //System.out.println("timestamp"+ timestamp);

                            if(RIDvalues.get(val) == null){
                                RIDvalues.put(val,timestamp);

                                //System.out.println("Adding RID and timestamp to hashmap"+ val+","+timestamp);
                                HashMap<String, ByteIterator> values = new HashMap<String, ByteIterator>();  
                                for(KeyValue kv2 : rs2.raw()){

                                    if(new String(kv2.getFamily()).equals("resources")){
                                        if(new String(kv2.getQualifier()).equals("rid"+Mid)){
                                            if(new String(kv2.getTimestamp()+"").equals(timestamp)){
                                                values.put(new String(kv2.getQualifier()), new ObjectByteIterator(val.getBytes()));   
                                            }

                                        }
                                        if(new String(kv2.getQualifier()).equals("walluserid"+Mid)){
                                            if(new String(kv2.getTimestamp()+"").equals(timestamp)){
                                                values.put(new String(kv2.getQualifier()), new ObjectByteIterator(new String(kv2.getValue()).getBytes()));   
                                            }

                                        }

                                        values.put("creatorid", new ObjectByteIterator(rowKey.getBytes()));   

                                    }

                                }

                                result.add(values);
                                RIDs++;
                            }
                        }

                    }
                }
            }
            table.close();
            hTablePool.putTable(table);


        } catch (IOException e) {
            e.printStackTrace();
        }

        return 0;
    }




    @Override
    public int getCreatedResources(int creatorID,
            Vector<HashMap<String, ByteIterator>> result) {
        HashMap<String, ByteIterator> values = new HashMap<String, ByteIterator>();
        try{

            HTableInterface table;
            table = hTablePool.getTable("users");
            String rowKey = creatorID+"";
            Get get = new Get(rowKey.getBytes());
            Result rs = table.get(get);
            values = new HashMap<String, ByteIterator>();
            for(KeyValue kv : rs.raw()){
                if(new String(kv.getFamily()).equals("resources"))
                {
                    String col_name = new String(kv.getQualifier());
                    String value = new String(kv.getValue());
                    values.put(col_name, new ObjectByteIterator(value.getBytes()));
                }
            }
            result.add(values);    
            table.close();
            hTablePool.putTable(table);


        } catch (IOException e){
            e.printStackTrace();
        }
        return 0;
    }



    @Override
    public int viewCommentOnResource(int requesterID, int profileOwnerID,
            int resourceID, Vector<HashMap<String, ByteIterator>> result) {
        try {


            HTableInterface table;
            table = hTablePool.getTable("users");
            String rowKey = ""+profileOwnerID;


            Get get = new Get(rowKey.getBytes());
            Result rs = table.get(get);
            Result rs2 = table.get(get);

            for(KeyValue kv : rs.raw()){
                String fam =new String(kv.getFamily()); 
                String col = new String(kv.getQualifier());
                if(fam.equals("manipulations") && col.contains("rid")){



                    int tempval=Integer.parseInt(new String(kv.getValue()));


                    //    System.out.println("Into RID" + new String(kv.getQualifier()) + "," + tempval);
                    if(tempval == resourceID){
                        //    System.out.println("RID :" + resourceID);

                        String mid = col.substring(4, col.length());
                        int Mid = Integer.parseInt(mid);

                        HashMap<String, ByteIterator> values = new HashMap<String, ByteIterator>();
                        for(KeyValue kv2 : rs2.raw()){
                            if(new String(kv2.getFamily()).equals("manipulations"))
                            {
                                if(new String(kv2.getQualifier()).equals("rid_"+Mid)){
                                    String col_name2 = new String(kv2.getQualifier());
                                    String value2 = new String(kv2.getValue());
                                    values.put(col_name2, new ObjectByteIterator(value2.getBytes()));
                                }
                                if(new String(kv2.getQualifier()).equals("modifierID_"+Mid)){
                                    String col_name2 = new String(kv2.getQualifier());
                                    String value2 = new String(kv2.getValue());
                                    values.put(col_name2, new ObjectByteIterator(value2.getBytes()));
                                }
                                if(new String(kv2.getQualifier()).equals("timestamp_"+Mid)){
                                    String col_name2 = new String(kv2.getQualifier());
                                    String value2 = new String(kv2.getValue());
                                    values.put(col_name2, new ObjectByteIterator(value2.getBytes()));
                                }
                                if(new String(kv2.getQualifier()).equals("type_"+Mid)){
                                    String col_name2 = new String(kv2.getQualifier());
                                    String value2 = new String(kv2.getValue());
                                    values.put(col_name2, new ObjectByteIterator(value2.getBytes()));
                                }
                                if(new String(kv2.getQualifier()).equals("content_"+Mid)){
                                    String col_name2 = new String(kv2.getQualifier());
                                    String value2 = new String(kv2.getValue());
                                    values.put(col_name2, new ObjectByteIterator(value2.getBytes()));
                                }
                            }
                        }
                        result.add(values);

                    }

                }
            }

            table.close();
            hTablePool.putTable(table);

        }
        catch (IOException e){
            e.printStackTrace();
        }
        return 0;       

    }

    @Override
    public int postCommentOnResource(int commentCreatorID,
            int profileOwnerID, int resourceID,
            HashMap<String, ByteIterator>commentValues) {

        try {

            HTableInterface table;
            table = hTablePool.getTable("users");
            String PK = "";
            PK += profileOwnerID;
            Put put = new Put(Bytes.toBytes(PK));
            int mid=Integer.parseInt(commentValues.get("mid").toString());
            put.add(Bytes.toBytes("manipulations"), Bytes.toBytes("rid_"+mid), Bytes
                    .toBytes(resourceID+""));
            put.add(Bytes.toBytes("manipulations"), Bytes.toBytes("modifierID_"+mid), Bytes
                    .toBytes(commentCreatorID+""));
            put.add(Bytes.toBytes("manipulations"), Bytes.toBytes("timestamp_"+mid), Bytes
                    .toBytes(commentValues.get("timestamp").toString()));
            put.add(Bytes.toBytes("manipulations"), Bytes.toBytes("type_"+mid), Bytes
                    .toBytes(commentValues.get("type").toString()));
            put.add(Bytes.toBytes("manipulations"), Bytes.toBytes("content_"+mid), Bytes
                    .toBytes(commentValues.get("content").toString()));
            //System.out.println("added friends");
            table.put(put);
            table.close();
            hTablePool.putTable(table);

        } catch (IOException e) {
            e.printStackTrace();
            return -2;
        }
        return 0;
    }


    @Override
    public int delCommentOnResource(int resourceCreatorID, int resourceID,
            int manipulationID) {

        try
        {

            HTableInterface table;
            table = hTablePool.getTable("users");

            String rowKey = ""+resourceCreatorID;
            Delete delete = new Delete(rowKey.getBytes());
            delete.deleteColumns(Bytes.toBytes("manipulations"), Bytes.toBytes("rid_"+manipulationID));
            delete.deleteColumns(Bytes.toBytes("manipulations"), Bytes.toBytes("modifierID_"+manipulationID));
            delete.deleteColumns(Bytes.toBytes("manipulations"), Bytes.toBytes("timestamp_"+manipulationID));
            delete.deleteColumns(Bytes.toBytes("manipulations"), Bytes.toBytes("type_"+manipulationID));
            delete.deleteColumns(Bytes.toBytes("manipulations"), Bytes.toBytes("content_"+manipulationID));
            table.delete(delete);
            table.close();
            hTablePool.putTable(table);

        }
        catch (IOException e) {
            e.printStackTrace();
            return -2;
        }
        return 0;
    }


    @Override
    public int thawFriendship(int friendid1, int friendid2) {
        //    System.out.println("Thaw Called");
        if(friendid1 < 0 || friendid2 < 0)
        {
            return -1;
        }
        try
        {

            HTableInterface table;
            table = hTablePool.getTable("users");

            //deleting from friendid1's row
            String rowKey = ""+friendid1;
            Put put = new Put(Bytes.toBytes(rowKey));
            Delete delete = new Delete(rowKey.getBytes());
            delete.deleteColumns(Bytes.toBytes("friends"), Bytes.toBytes("friend_"+friendid2));
            delete.deleteColumns(Bytes.toBytes("friends"), Bytes.toBytes("status_"+friendid2));
            table.delete(delete);
            Get get = new  Get(rowKey.getBytes());
            Result rs = table.get(get);
            for(KeyValue kv : rs.raw()){
                if((new String(kv.getQualifier())).equals("confriends"))
                {
                    int confriends=Integer.parseInt(new String(kv.getValue()));
                    confriends-=1;
                    put.add(Bytes.toBytes("stats"), Bytes.toBytes("confriends"), Bytes
                            .toBytes(confriends+""));
                }
            }
            table.put(put);
            //deleting from friendid2's row
            String rowKey2 = ""+friendid2;
            Put put2 = new Put(Bytes.toBytes(rowKey2));
            Delete delete2 = new Delete(rowKey2.getBytes());
            delete2.deleteColumns(Bytes.toBytes("friends"), Bytes.toBytes("friend_"+friendid1));
            delete2.deleteColumns(Bytes.toBytes("friends"), Bytes.toBytes("status_"+friendid1));
            table.delete(delete2);
            get = new  Get(rowKey2.getBytes());
            rs = table.get(get);
            for(KeyValue kv : rs.raw()){
                if((new String(kv.getQualifier())).equals("confriends"))
                {
                    int confriends=Integer.parseInt(new String(kv.getValue()));
                    confriends-=1;
                    put2.add(Bytes.toBytes("stats"), Bytes.toBytes("confriends"), Bytes
                            .toBytes(confriends+""));
                }
            }
            table.put(put2);
            table.close();
            hTablePool.putTable(table);


        }
        catch (IOException e) {
            e.printStackTrace();
            return -2;
        }
        return 0;

    }


    @Override
    public HashMap<String, String> getInitialStats() {

        HashMap<String, String> stats = new HashMap<String, String>();
        try {

            HTableInterface table;
            table = hTablePool.getTable("users");
            String rowKey = "0";
            int number =0;
            String inviterID;
            Get get = new Get(rowKey.getBytes());
            Result rs = table.get(get);
            Scan s = new Scan();
            ResultScanner ss = table.getScanner(s);
            for(Result r:ss){
                number++;
            }

            stats.put("usercount", number+"");
            for(KeyValue kv : rs.raw()){
                String fam_name = new String(kv.getQualifier());
                String value = new String(kv.getValue());

                if(fam_name.equals("confriends"))
                {
                    stats.put("avgfriendsperuser",value);                
                }
                if(fam_name.equals("penfriends"))
                {
                    stats.put("avgpendingperuser",value);
                }
                if(fam_name.equals("numresources"))
                {
                    //System.out.println("col name !!!!!   "+fam_name);
                    //System.out.println("values!! !!!!!   "+value);
                    stats.put("resourcesperuser",value);
                }
            }

            table.close();
            hTablePool.putTable(table);

        }
        catch (IOException e) {
            e.printStackTrace();
            return null;
        }
        return stats;
    }


    @Override
    public int CreateFriendship(int inviterID, int inviteeID) {
        //System.out.println("Create Called");
        if(inviterID < 0 || inviteeID < 0)
        {
            return -1;
        }
        try
        {

            HTableInterface table;
            table = hTablePool.getTable("users");
            //adding inviterID to frienship table
            String PK = "";
            PK += inviterID;
            Put put = new Put(Bytes.toBytes(PK));
            String colname= "friend_"+inviteeID;
            put.add(Bytes.toBytes("friends"), Bytes.toBytes(colname), Bytes
                    .toBytes(inviteeID));
            String statname="status_"+inviteeID;
            put.add(Bytes.toBytes("friends"), Bytes.toBytes(statname), Bytes
                    .toBytes("2"));
            table.put(put);

            Get get = new  Get(PK.getBytes());
            Result rs = table.get(get);
            for(KeyValue kv : rs.raw()){
                if((new String(kv.getQualifier())).equals("confriends"))
                {
                    int confriends=Integer.parseInt(new String(kv.getValue()));
                    confriends+=1;
                    put.add(Bytes.toBytes("stats"), Bytes.toBytes("confriends"), Bytes
                            .toBytes(confriends+""));
                }
            }
            table.put(put);

            //change status of inviteeID entry in table
            PK = "";
            PK += inviteeID;
            Put put2 = new Put(Bytes.toBytes(PK));
            String col2name= "friend_"+inviterID;
            put2.add(Bytes.toBytes("friends"), Bytes.toBytes(col2name), Bytes
                    .toBytes(inviterID));
            statname="status_"+inviterID;
            put2.add(Bytes.toBytes("friends"), Bytes.toBytes(statname), Bytes
                    .toBytes("2"));

            table.put(put2);
            get = new  Get(PK.getBytes());
            rs = table.get(get);
            for(KeyValue kv : rs.raw()){
                if((new String(kv.getQualifier())).equals("confriends"))
                {
                    int confriends=Integer.parseInt(new String(kv.getValue()));
                    confriends+=1;
                    put2.add(Bytes.toBytes("stats"), Bytes.toBytes("confriends"), Bytes
                            .toBytes(confriends+""));
                }

            }
            table.put(put2);
            table.close();
            hTablePool.putTable(table);


        }
        catch (Exception e)
        {
            e.printStackTrace();
            return -2;
        }
        return 0;
    }


    @Override
    public void createSchema(Properties props) {
        String tablename = "users";
        String[] familys = { "users" , "friends" , "resources" , "manipulations", "stats" };

        try{
            HBaseAdmin admin = new HBaseAdmin(conf);
            if (admin.tableExists(tablename)) {
                admin.disableTable(tablename);
                admin.deleteTable(tablename);
            }
            HTableDescriptor tableDesc = new HTableDescriptor(tablename);
            for (int i = 0; i < familys.length; i++) {
                tableDesc.addFamily(new HColumnDescriptor(familys[i]));
            }
            admin.createTable(tableDesc);

        }catch(Exception e){
            e.printStackTrace();
        }

    }


    @Override
    public int queryPendingFriendshipIds(int inviteeID,
            Vector<Integer> pendingIds) {

        if(inviteeID < 0)
        {
            return -1;
        }
        try{

            HTableInterface table;
            table = hTablePool.getTable("users");
            String rowKey = inviteeID+"";
            String inviterID;
            Get get = new Get(rowKey.getBytes());
            Result rs = table.get(get);
            for(KeyValue kv : rs.raw()){

                if(new String(kv.getFamily()).equals("friends")){

                    String fam_name = new String(kv.getQualifier());
                    String value = new String(kv.getValue());

                    if((fam_name.substring(0,6).equals("status")) && (value.equals("1")))
                    {
                        inviterID=fam_name.substring(7,fam_name.length());
                        pendingIds.add(Integer.parseInt(inviterID));
                    }
                }

            }
            table.close();
            hTablePool.putTable(table);


        } catch ( Exception e){
            e.printStackTrace();
            return -2;
        }
        return 0;
    }


    @Override
    public int queryConfirmedFriendshipIds(int inviteeID,
            Vector<Integer> confirmedIds) {

        if(inviteeID < 0)
        {
            return -1;
        }
        try{

            HTableInterface table;
            table = hTablePool.getTable("users");
            String rowKey = inviteeID+"";
            String inviterID;
            Get get = new Get(rowKey.getBytes());
            Result rs = table.get(get);
            for(KeyValue kv : rs.raw()){

                if(new String(kv.getFamily()).equals("friends")){

                    String fam_name = new String(kv.getQualifier());
                    String value = new String(kv.getValue());

                    if((fam_name.substring(0,6).equals("status")) && (value.equals("2")))
                    {
                        inviterID=fam_name.substring(7,fam_name.length());
                        confirmedIds.add(Integer.parseInt(inviterID));
                    }
                }

            }

            table.close();
            hTablePool.putTable(table);


        } catch ( Exception e){
            e.printStackTrace();
            return -2;
        }
        return 0;
    }


}