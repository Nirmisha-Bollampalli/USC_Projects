import java.sql.*;
import oracle.jdbc.driver.OracleDriver;
import java.io.*;
import java.util.*;



public class populate
{

	  public static void main(String args[]) throws SQLException
	  {
		  System.out.println("Write Text File to Table!");
		  Connection connection = null;
		  Statement st;


			 try {
			     // Load the JDBC driver
			     String driverName = "oracle.jdbc.driver.OracleDriver";
			     Class.forName(driverName);
			     // Create a connection to the database
			     String serverName = "127.0.0.1";
			     String portNumber = "1521";
			     String sid = "ORCL";
			     String url = "jdbc:oracle:thin:@" + serverName + ":" + portNumber + ":" + sid;
			     String username = "scott";
			     String password = "Nirmisha14";
			     connection = DriverManager.getConnection(url, username, password);
			     System.out.println("success--success");
			     }catch (Exception e) {}

		  try
		  {
			  System.out.println("Im in");
			         for (int i=0;i<args.length;i++)
			         {

			                 FileInputStream fstream = new FileInputStream(args[i]);
			                 DataInputStream dstream = new DataInputStream(fstream);
			                 BufferedReader bf = new BufferedReader(new InputStreamReader(dstream));
			                 String data ;
			                 String comma = ",";


			  if(args[i].equals("building.xy"))
			  {
			              st = connection.createStatement();
		                  String clear="";
			  			  clear = "DELETE FROM BUILDING";

			  			  int row0 = st.executeUpdate(clear);
			  			  int comm0 = st.executeUpdate("commit");

						  while((data = bf.readLine()) != null)
						  {

							  StringTokenizer stoken = new StringTokenizer(data,comma);
							  String BID = stoken.nextToken();
							  String Bname = stoken.nextToken();
							  String No_Of_Vertices = stoken.nextToken();

							  String shape = "";

							  while(stoken.hasMoreTokens())
							  {
								  shape = shape + comma + stoken.nextToken();
							  }

						      shape = shape.substring(1);
							  st = connection.createStatement();
						      String lsqlstr ="";
						      lsqlstr = "INSERT INTO Building VALUES ('"+ BID +"','"+ Bname +"',"+ No_Of_Vertices+ ","+ "MDSYS.SDO_GEOMETRY(2003,NULL,NULL,MDSYS.SDO_ELEM_INFO_ARRAY(1,1003,1), MDSYS.SDO_ORDINATE_ARRAY("+ shape +"))" + ")";
							  System.out.println(lsqlstr);
							  int row = st.executeUpdate(lsqlstr);
							  int comm = st.executeUpdate("commit");
						      st.close();
					       }
					       System.out.println("All data are inserted in the Building table");
			  }

			  else if(args[i].equals("ap.xy"))
		      {
                              st = connection.createStatement();

				   			  String clear1="";
				   			  clear1 = "DELETE FROM ap";
				   			  int row1 = st.executeUpdate(clear1);
				   			  //System.out.println(row +" row inserted");
				   			  int comm1 = st.executeUpdate("commit");

				              while((data = bf.readLine()) != null)
				  			  {

				  				  StringTokenizer stoken = new StringTokenizer(data,comma);
				  				  String AID = stoken.nextToken();

				  				  String appoints = "";

								  while(stoken.hasMoreTokens())
								  {
									  appoints = appoints + comma + stoken.nextToken();
								  }

                                  //System.out.println(appoints);
                                  appoints = appoints.replace(" ","");

								  String[] cols;

								  cols = appoints.split(comma);

				  				  st = connection.createStatement();
					  			  String lsqlstr ="";
					  			  lsqlstr = "INSERT INTO ap VALUES('"+AID+"',"+ "MDSYS.SDO_GEOMETRY(2001,NULL,MDSYS.SDO_POINT_TYPE("+ cols[1] + ","+ cols[2] + ",NULL),NULL,NULL)"+",'"+ cols[3] +"')";
	                              System.out.println(lsqlstr);
					  			  int row = st.executeUpdate(lsqlstr);
					  			  int comm = st.executeUpdate("commit");
					  			  st.close();
					  		      }
				  		          System.out.println("All data are inserted in the Access_Point table");

			         }

			        else if(args[i].equals("people.xy"))
			         {
                          System.out.println("Hi");
			        	  st = connection.createStatement();

			   			  String clear2="";
			   			  clear2 = "DELETE FROM People1 ";
			   			  int row2 = st.executeUpdate(clear2);
             			  int comm2 = st.executeUpdate("commit");

			              while((data = bf.readLine()) != null)
			  			  {

			  				  StringTokenizer stoken = new StringTokenizer(data,comma);
			  				  String PID = stoken.nextToken();
			  				  String points = "";

							  while(stoken.hasMoreElements())
							  {
								  points = points + comma + stoken.nextToken();
							  }
							 // System.out.println(points);
							  points = points.substring(1);
			  				  st = connection.createStatement();
				  			  String lsqlstr ="";
				  			  lsqlstr = "INSERT INTO people1 VALUES('"+PID+"',"+ "MDSYS.SDO_GEOMETRY(2001,NULL,MDSYS.SDO_POINT_TYPE("+points+",NULL),NULL,NULL))";
                              System.out.println(lsqlstr);
				  			  int row = st.executeUpdate(lsqlstr);
				  			  int comm = st.executeUpdate("commit");
				  			  st.close();
				  		      }
			  		          System.out.println("All data are inserted in the People table");

			         }

      		  bf.close();

			  }

		  } catch (Exception e) {System.out.println(e.getMessage());}

	}

}






