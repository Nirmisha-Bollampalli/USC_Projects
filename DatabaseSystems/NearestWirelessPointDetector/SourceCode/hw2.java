import java.awt.*;
import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;
import java.awt.event.MouseEvent;
import java.awt.event.MouseListener;
import java.awt.event.MouseMotionAdapter;
import java.awt.event.MouseMotionListener;
import java.awt.image.BufferedImage;
import java.io.*;
import java.util.Arrays;
import javax.swing.event.ChangeListener;
import javax.swing.event.ChangeEvent;


import javax.imageio.ImageIO;
import javax.swing.*;

import java.sql.*;
import java.awt.event.*;

import oracle.jdbc.driver.OracleDriver;
import java.util.*;
import java.awt.Point;

public class hw2 extends JPanel
{
    //Connection declaration
	    public static Connection con = null;
	    BufferedImage image;
	    public static Graphics g;
	    int count=0;
	// GUI
	    public JCheckBox CheckB;
		public JCheckBox CheckB0;
		public JCheckBox CheckB1;
		public JLabel    label;
		public JLabel    label0;
		public JLabel    label1;
		public JLabel    labelq;
		public JLabel    labelq0;
		public JLabel    labelq1;
		public JLabel    labelq2;
		public JLabel    labelq3;
		public JRadioButton radio0;
		public JRadioButton radio1;
		public JRadioButton radio2;
		public JRadioButton radio3;
		public JButton Button;
		public JButton Button1;
		public JTextArea text;
		public JScrollPane scrollPane;

	 	public JFrame f;
	 	public JPanel p;


	   //Active _Features -- Display
	 	private boolean  Building =false;
	 	private boolean People =false;
	    private boolean AP = false;
	    private boolean Clear = false;

		 	//Building Variables
		 	String[] coord = new String[1000];
		 	int n[] = new int[100];
		 	int i2=0,x2count=0,c;
		 	String[] x2 = new String[500] ;
		 	String[] temp = new String[1000];
		 	String[] temp2 = new String[1000];
		 	String[] xp1 = new String[1000];
			String[] yp1 = new String[1000];
			int xpoint[] = new int[500];
			int ypoint[]= new int[500];

			//People Variables
			String[] coordp = new String[1000];
		 	int np[] = new int[100];
		 	int p2=0,x2pcount=0,cp;
		 	String[] x2p = new String[500] ;
		 	String[] tempp = new String[1000];
		 	String[] tempp2 = new String[1000];
		 	String[] xpp1 = new String[1000];
			String[] ypp1 = new String[1000];
			int xppoint[] = new int[500];
			int yppoint[]= new int[500];

			//AP Variables
			String[] coorda = new String[1000];
		 	int na[] = new int[100];
		 	int a2=0,x2acount=0,ca;
		 	String[] x2a = new String[500] ;
		 	String[] tempa = new String[1000];
		 	String[] tempa2 = new String[1000];
		 	String[] xpa1 = new String[1000];
			String[] ypa1 = new String[1000];
			int xapoint[] = new int[500];
			int yapoint[]= new int[500];

		//Point Query
			private Point mouseClick = null;
			int xnew,ynew;
			private boolean MouseClick = false;
			int ClickCount=0;
			MouseEvent e;

			//Building Variables
			String[] coordBP = new String[1000];
		 	int nBP[] = new int[100];
		 	int i2BP=0,x2BPcount=0,cBP;
		 	String[] x2BP = new String[500] ;
		 	String[] tempBP = new String[1000];
		 	String[] temp2BP = new String[1000];
		 	String[] xp1BP = new String[1000];
			String[] yp1BP = new String[1000];
			int xpointBP[] = new int[500];
			int ypointBP[]= new int[500];
					 //Nearest Neighbor
					String[] coordsub2 = new String[1000];
				 	int npsub2[] = new int[100];
				 	int p2sub2=0,x2psubcount2=0,cpsub2;
				 	String[] x2psub2 = new String[500] ;
				 	String[] tempsub2 = new String[1000];
				 	String[] temp2sub2 = new String[1000];
				 	String[] xp1sub2 = new String[1000];
					String[] yp1sub2 = new String[1000];
					int xpointsub2[] = new int[500];
					int ypointsub2[]= new int[500];




			//AP Variables
			String[] coordaBP = new String[1000];
		 	int naBP[] = new int[100];
		 	int a2BP=0,x2BPacount=0,caBP,r=0;
		 	String[] x2aBP = new String[500] ;
		 	String[] tempaBP = new String[1000];
		 	String[] tempa2BP = new String[1000];
		 	String[] xpa1BP = new String[1000];
			String[] ypa1BP = new String[1000];
			int xapointBP[] = new int[500];
			int yapointBP[]= new int[500];
					 //Nearest Neighbor
					String[] coordsub1 = new String[1000];
				 	int npsub1[] = new int[100];
				 	int p2sub1=0,x2psubcount1=0,cpsub1;
				 	String[] x2psub1 = new String[500] ;
				 	String[] tempsub1 = new String[1000];
				 	String[] xp1sub1 = new String[1000];
					String[] yp1sub1 = new String[1000];
					int xpointsub1[] = new int[500];
					int ypointsub1[]= new int[500];



			//People Variables
			String[] coordpBP = new String[1000];
		 	int npBP[] = new int[100];
		 	int p2BP=0,x2pBPcount=0,cpBP;
		 	String[] x2pBP = new String[500] ;
		 	String[] temppBP = new String[1000];
		 	String[] tempp2BP = new String[1000];
		 	String[] xpp1BP = new String[1000];
			String[] ypp1BP = new String[1000];
			int xppointBP[] = new int[500];
			int yppointBP[]= new int[500];
		            //Nearest Neighbor
					String[] coordsub = new String[1000];
				 	int npsub[] = new int[100];
				 	int p2sub=0,x2psubcount=0,cpsub;
				 	String[] x2psub = new String[500] ;
				 	String[] tempsub = new String[1000];
				 	String[] xp1sub = new String[1000];
					String[] yp1sub = new String[1000];
					int xpointsub[] = new int[500];
					int ypointsub[]= new int[500];

		 //Ap Covered People
					private Point mousePress = null;
					private Boolean mousePress1 = false;
					String[] coordap = new String[1000];
				 	int nap[] = new int[100];
				 	int ap2=0,x2apcount=0,cap,a,b;
				 	String[] x2ap = new String[500] ;
				 	String[] tempap = new String[1000];
				 	String[] temp2ap = new String[1000];
				 	String[] xapp1 = new String[1000];
					String[] yapp1 = new String[1000];
					int xappoint[] = new int[500];
					int yappoint[]= new int[500];
					//People within radius

					String[] coordapp = new String[1000];
				 	int napp[] = new int[100];
				 	int app2=0,x2appcount=0,capp;
				 	String[] x2app = new String[500] ;
				 	String[] tempapp = new String[1000];
				 	String[] temp2app = new String[1000];
				 	String[] xappp1 = new String[1000];
					String[] yappp1 = new String[1000];
					int xapppoint[] = new int[500];
					int yapppoint[]= new int[500];

					//A bit out of radius people
					String[] coordapp1 = new String[1000];
				 	int napp1[] = new int[100];
				 	int app21=0,x2app1count=0,capp1;
				 	String[] x2app1 = new String[500] ;
				 	String[] tempapp1 = new String[1000];
				 	String[] temp2app1 = new String[1000];
				 	String[] xappp11 = new String[1000];
					String[] yappp11 = new String[1000];
					int xapppoint1[] = new int[500];
					int yapppoint1[]= new int[500];

					//Out of radius
					String[] coordapp2 = new String[1000];
				 	int napp2[] = new int[100];
				 	int app22=0,x2app2count=0,capp2;
				 	String[] x2app2 = new String[500] ;
				 	String[] tempapp2 = new String[1000];
				 	String[] temp2app2 = new String[1000];
				 	String[] xappp12 = new String[1000];
					String[] yappp12 = new String[1000];
					int xapppoint2[] = new int[500];
					int yapppoint2[]= new int[500];
		//Range Query
					 private Boolean mousePress2 = false;
					 private Rectangle rect = null;
					 private Rectangle rectPoint = null;
					 private boolean drawing = false;
					 private boolean drawpoint = false;
					 private static final long serialVersionUID = 1L;
					 private static final Color DRAWING_RECT_COLOR = Color.RED;
					 private static final Color DRAWN_RECT_COLOR = Color.RED;
					 private Point mousePress4 = null;
					 int Rectangle =0,x,y,width,height,Buil=0,Peop=0,access=0,ap_people=0;

    public hw2(BufferedImage image)
    {

    	this.image = image;

    }

	public static void main(String[] args) throws IOException
    {

        try
        {
        String driverName = "oracle.jdbc.driver.OracleDriver";
        Class.forName(driverName);
        String serverName = "127.0.0.1";
        String portNumber = "1521";
        String sid = "ORCL";
        String url = "jdbc:oracle:thin:@" + serverName + ":" + portNumber + ":" + sid;
        String username = "scott";
        String password = "Nirmisha14";
        con  = DriverManager.getConnection(url, username, password);
        System.out.println("Connected");
        }
        catch(Exception e)
        {
        	System.out.println("Could not Connect");
        };

         String path = "C:\\Users\\Nirmisha\\Documents\\Database_Systems\\Assignments\\HW2\\map.jpg";
         BufferedImage image = ImageIO.read(new File(path));

         hw2 obj = new hw2(image);
         obj.display();

     }


	 public void display() throws IOException
	   {

	       String path = "C:\\Users\\Nirmisha\\Documents\\Database_Systems\\Assignments\\HW2\\map.jpg";
	       BufferedImage image = ImageIO.read(new File(path));

	       f = new JFrame("Nirmisha Bollampalli : 5319608098");

	       f.setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);


	       f.setSize(1100,700);
	       f.setLocation(0,0);
	       f.setBounds(0,0,1100,700);
	       JLabel labelp = new JLabel("ACTIVE FEATURE TYPES");
	       labelp.setBounds(900, -20,200,200);


	       CheckB = new JCheckBox();
	       CheckB.setBounds(900, 100,20,20);
	       label = new JLabel("BUILDING");
	       label.setBounds(940, 80,65,65);


	       CheckB0 = new JCheckBox();
	       CheckB0.setBounds(900, 150,20,20);
	       label0 = new JLabel("ACCESS POINT");
	       label0.setBounds(940, 110,100,100);


	       CheckB1 = new JCheckBox();
	       CheckB1.setBounds(900, 200,20,20);
	       label1 = new JLabel("PEOPLE");
	       label1.setBounds(940,185,50,50);

	       labelq = new JLabel("QUERY TYPE");
	       labelq.setBounds(940,250,100,50);

	       radio0 = new JRadioButton();
	       radio0.setBounds(900, 300, 20, 20);
	       labelq0 = new JLabel("RANGE QUERY");
	       labelq0.setBounds(940, 260, 100, 100);

	       radio1 = new JRadioButton();
	       radio1.setBounds(900, 350, 20, 20);
	       labelq1 = new JLabel("POINT QUERY");
	       labelq1.setBounds(940, 310, 100, 100);


	       radio2 = new JRadioButton();
	       radio2.setBounds(900, 400, 20, 20);
	       labelq2 = new JLabel("APCOVEREDPEOPLE");
	       labelq2.setBounds(940, 360, 120, 100);


	       radio3 = new JRadioButton();
	       radio3.setBounds(900, 450, 20, 20);
	       labelq3 = new JLabel("WHOLE RANGE");
	       labelq3.setBounds(940, 410, 100, 100);

	       Button = new JButton();
	       Button.setText("SUBMIT");
	       Button.setBounds(900, 500,100, 40);

	       Button1 = new JButton();
	       Button1.setText("CLEAR");
	       Button1.setBounds(900, 550,100, 40);


	       //JPanel BottomPanel=new JPanel();
	       //BottomPanel.setPreferredSize(new Dimension(1,40));
	       //BottomPanel.setBounds(1,600,50,50);

	       text=new JTextArea (5,100);
	       text.setEditable(true);
	       text.setText("Your submitted query should be displayed here");
	       text.setBounds(20,600,900,50);
	       //text.setCaretPosition(text.getDocument().getLength());
	       scrollPane= new JScrollPane(text,JScrollPane.VERTICAL_SCROLLBAR_ALWAYS,JScrollPane.HORIZONTAL_SCROLLBAR_ALWAYS);
	       scrollPane.setPreferredSize(new Dimension(700, 700));
	       scrollPane.setBounds(1,600,800,50);

	       f.add(labelp);
	      // f.add(text);
	       f.add(scrollPane,BorderLayout.CENTER);

	      // frame.add(ImageLabel);
	       f.add(CheckB);
	       f.add(label);
	       f.add(CheckB0);
	       f.add(label0);
	       f.add(CheckB1);
	       f.add(label1);

	       f.add(labelq);
	       f.add(radio0);
	       f.add(radio1);
	       f.add(radio2);
	       f.add(radio3);
	       f.add(labelq0);
	       f.add(labelq1);
	       f.add(labelq2);
	       f.add(labelq3);

	       f.add(Button);
	       f.add(Button1);


	       p = new JPanel();
	       p.setLayout(null);
	       p.setSize(820,580);

	       final hw2 obj1 = new hw2(image);
	       f.add(obj1);

	       final MouseLabel MouseLabel = new MouseLabel();
	       JLayeredPane layeredPane = f.getRootPane().getLayeredPane();
	       layeredPane.add(MouseLabel, JLayeredPane.DRAG_LAYER);
	       MouseLabel.setBounds(0, 0, p.getWidth(), p.getHeight());
	       f.addMouseMotionListener(new MouseMotionAdapter()
	       {
				      public void mouseMoved(MouseEvent me)
				      {
				       MouseLabel.x = me.getX();
				       MouseLabel.y = me.getY();
				       MouseLabel.repaint();
				      }

	        });

	       final ButtonGroup group = new ButtonGroup();
           group.add(CheckB);
           final ButtonGroup group1 = new ButtonGroup();
           group1.add(CheckB0);
           final ButtonGroup group2 = new ButtonGroup();
           group2.add(CheckB1);
           final ButtonGroup group3 = new ButtonGroup();
           group3.add(radio3);
           group3.add(radio1);
           group3.add(radio0);
           group3.add(radio2);
	       // Display all Active Features
	       ActionListener actionListener = new ActionListener()
	       {
	    	      public void actionPerformed(ActionEvent actionEvent)
	    	      {

	    	    	 if(actionEvent.getSource() == Button)
	    	    	 {

	    	    		  if(CheckB.isSelected() & CheckB0.isSelected() &  CheckB1.isSelected() & radio3.isSelected())
	      	              {


	    	    			  obj1.Active_Feature_Building(g);
	    	    			  obj1.Active_Feature_People(g);
	    	    			  obj1.Active_Feature_AP(g);
	    	    			  text.append("\nQuery"+obj1.count+":"+"select dbms_lob.substr(c.shape.Get_WKT(), 4000, 1 ) as coord,No_of_vertices from building c");
	    	    			  obj1.count++;
	    	    			  text.append("\nQuery"+obj1.count+":"+"select dbms_lob.substr(p.Points.Get_WKT(), 4000, 1 ) as coord from people1 p");
	    	    			  obj1.count++;
	    	    			  text.append("\nQuery"+obj1.count+":"+"select dbms_lob.substr(a.appoints.Get_WKT(), 4000, 1 ) as coord,radius from ap a");
	    	    			  obj1.count++;
	      	              }

	    	    	      else if(CheckB.isSelected() & CheckB0.isSelected() & radio3.isSelected())
	    	    	      {

	     	    	    	  obj1.Active_Feature_Building(g);
	   	        	          obj1.Active_Feature_AP(g);
	   	        	          text.append("\nQuery"+obj1.count+":"+"select dbms_lob.substr(c.shape.Get_WKT(), 4000, 1 ) as coord,No_of_vertices from building c");
	    	    			  obj1.count++;
	    	    			  text.append("\nQuery"+obj1.count+":"+"select dbms_lob.substr(a.appoints.Get_WKT(), 4000, 1 ) as coord,radius from ap a");
	    	    			  obj1.count++;
	    	    	      }

	    	    	      else if(CheckB.isSelected() & CheckB1.isSelected() & radio3.isSelected())
	    	    	      {
	    	    	    	   obj1.Active_Feature_Building(g);
	    	    	    	  obj1.Active_Feature_People(g);
	    	    	    	  text.append("\nQuery"+obj1.count+":"+"select dbms_lob.substr(c.shape.Get_WKT(), 4000, 1 ) as coord,No_of_vertices from building c");
	    	    			  obj1.count++;
	    	    			  text.append("\nQuery"+obj1.count+":"+"select dbms_lob.substr(p.Points.Get_WKT(), 4000, 1 ) as coord from people1 p");
	    	    			  obj1.count++;
	    	    	      }

	    	              else if(CheckB0.isSelected() & CheckB1.isSelected() & radio3.isSelected())
	    	              {

	    	            	  obj1.Active_Feature_AP(g);
	    	            	  obj1.Active_Feature_People(g);
	    	            	  text.append("\nQuery"+obj1.count+":"+"select dbms_lob.substr(p.Points.Get_WKT(), 4000, 1 ) as coord from people1 p");
	    	    			  obj1.count++;
	    	    			  text.append("\nQuery"+obj1.count+":"+"select dbms_lob.substr(a.appoints.Get_WKT(), 4000, 1 ) as coord,radius from ap a");
	    	    			  obj1.count++;

	    	              }
	    	              else if(CheckB1.isSelected() & radio3.isSelected())
	    	              {
	    	            	 obj1.Active_Feature_People(g);
	    	            	 text.append("\nQuery"+obj1.count+":"+"select dbms_lob.substr(p.Points.Get_WKT(), 4000, 1 ) as coord from people1 p");
	    	    			  obj1.count++;

	    	              }
	    	              else if(CheckB.isSelected() & radio3.isSelected() )
	    	    	      {
	    	            	  obj1.Active_Feature_Building(g);
	    	            	  text.append("\nQuery"+obj1.count+":"+"select dbms_lob.substr(c.shape.Get_WKT(), 4000, 1 ) as coord,No_of_vertices from building c");
	    	    			  obj1.count++;
	    	    	      }
	    	              else if(CheckB0.isSelected() & radio3.isSelected())
	    	              {
	    	            	  obj1.Active_Feature_AP(g);
	    	            	  text.append("\nQuery"+obj1.count+":"+"select dbms_lob.substr(a.appoints.Get_WKT(), 4000, 1 ) as coord,radius from ap a");
	    	    			  obj1.count++;

	    	              }

	    	         }



	    	       }
	    	    };
	    	ActionListener actionListener1 = new ActionListener()
	 	       {
	 	    	      public void actionPerformed(ActionEvent actionEvent1)
	 	    	      {

	    	            if(actionEvent1.getSource() == Button1)
				   	    	 {

				   	    		group.clearSelection();
				   	    		group1.clearSelection();
				   	    		group2.clearSelection();
				   	    		group3.clearSelection();

				   	    		obj1.clear();

				   	    	 }
	 	    	      }
	 	    	 };

	        CheckB.addActionListener(actionListener);
	        CheckB0.addActionListener(actionListener);
	        CheckB1.addActionListener(actionListener);
	        radio3.addActionListener(actionListener);
	        Button.addActionListener(actionListener);
            Button1.addActionListener(actionListener1);

            //Point Query
          ActionListener actionListener2 = new ActionListener()
 	      {
 	    	      public void actionPerformed(ActionEvent actionEvent2)
 	    	      {
			            if(radio1.isEnabled())
			            {
			                obj1.MouseClick = true;


			             }

 	    	      }
 	      } ;
 	     ActionListener actionListener3 = new ActionListener()
	      {
	    	      public void actionPerformed(ActionEvent actionEvent3)
	    	      {
				 	     if(actionEvent3.getSource() == Button)
				         {
				 	    	if(CheckB.isSelected() & CheckB0.isSelected() &  CheckB1.isSelected() & radio1.isSelected())
				 	    	{
				 	    		  obj1.Active_Feature_Building_Point(g);
		    	    			  obj1.Active_Feature_People_Point(g);
		    	    			  obj1.Active_Feature_AP_Point(g);
		    	    			  text.append("\nQuery"+obj1.count+":"+"select dbms_lob.substr(b.shape.Get_WKT(), 4000, 1 ) as coord,No_of_vertices from building b where sdo_filter(b.shape,SDO_GEOMETRY(2003,NULL, NULL,SDO_ELEM_INFO_ARRAY(1,1003,4),SDO_ORDINATE_ARRAY("+xnew+","+(ynew-70)+","+(xnew+70)+","+ynew+","+xnew+","+(ynew+70)+")),'querytype=WINDOW')='TRUE' AND SDO_RELATE(b.shape,SDO_GEOMETRY(2003,NULL, NULL,SDO_ELEM_INFO_ARRAY(1,1003,4),SDO_ORDINATE_ARRAY("+xnew+","+(ynew-70)+","+(xnew+70)+","+ynew+","+xnew+","+(ynew+70)+")),'mask = INSIDE+OVERLAPBDYINTERSECT querytype = WINDOW') = 'TRUE'");
		    	    			  obj1.count++;
		    	    			  text.append("\nQuery"+obj1.count+":"+"select dbms_lob.substr(b.shape.Get_WKT(), 4000, 1 ) as coord,No_Of_vertices from building b where sdo_filter(b.shape,SDO_GEOMETRY(2003,NULL, NULL,SDO_ELEM_INFO_ARRAY(1,1003,4),SDO_ORDINATE_ARRAY("+xnew+","+(ynew-70)+","+(xnew+70)+","+ynew+","+xnew+","+(ynew+70)+")),'querytype=WINDOW')='TRUE' AND SDO_RELATE(b.shape,SDO_GEOMETRY(2003,NULL, NULL,SDO_ELEM_INFO_ARRAY(1,1003,4),SDO_ORDINATE_ARRAY("+xnew+","+(ynew-70)+","+(xnew+70)+","+ynew+","+xnew+","+(ynew+70)+")),'mask = INSIDE+OVERLAPBDYINTERSECT querytype = WINDOW') = 'TRUE'  intersect select dbms_lob.substr(b.shape.Get_WKT(), 4000, 1 ) as coord,No_of_vertices from building b where SDO_NN(b.shape,sdo_geometry(2001, NULL, sdo_point_type("+xnew+","+ynew+",NULL), NULL,NULL),'querytype=Filter sdo_num_res=1')='TRUE'");
		      	        	      obj1.count++;
		      	        	      text.append("\nQuery"+obj1.count+":"+"select dbms_lob.substr(a.appoints.Get_WKT(), 4000, 1 ) as coord,radius from ap a where sdo_filter(a.appoints,SDO_GEOMETRY(2003,NULL, NULL,SDO_ELEM_INFO_ARRAY(1,1003,4),SDO_ORDINATE_ARRAY("+xnew+","+(ynew-70)+","+(xnew+70)+","+ynew+","+xnew+","+(ynew+70)+")),'querytype=WINDOW')='TRUE' AND SDO_RELATE(a.appoints,SDO_GEOMETRY(2003,NULL, NULL,SDO_ELEM_INFO_ARRAY(1,1003,4),SDO_ORDINATE_ARRAY("+xnew+","+(ynew-70)+","+(xnew+70)+","+ynew+","+xnew+","+(ynew+70)+")),'mask = INSIDE+OVERLAPBDYINTERSECT querytype = WINDOW') = 'TRUE'");
		      	        	      obj1.count++;
		      	        	      text.append("\nQuery"+obj1.count+":"+"select dbms_lob.substr(a.appoints.Get_WKT(), 4000, 1 ) as coord,radius from ap a where sdo_filter(a.appoints,SDO_GEOMETRY(2003,NULL, NULL,SDO_ELEM_INFO_ARRAY(1,1003,4),SDO_ORDINATE_ARRAY("+xnew+","+(ynew-70)+","+(xnew+70)+","+ynew+","+xnew+","+(ynew+70)+")),'querytype=WINDOW')='TRUE' AND SDO_RELATE(a.appoints,SDO_GEOMETRY(2003,NULL, NULL,SDO_ELEM_INFO_ARRAY(1,1003,4),SDO_ORDINATE_ARRAY("+xnew+","+(ynew-70)+","+(xnew+70)+","+ynew+","+xnew+","+(ynew+70)+")),'mask = INSIDE+OVERLAPBDYINTERSECT querytype = WINDOW') = 'TRUE' intersect (select dbms_lob.substr(a.appoints.Get_WKT(), 4000, 1 ) as coord,radius from ap a where SDO_NN(a.appoints,sdo_geometry(2001, NULL, sdo_point_type("+xnew+","+ynew+",NULL), NULL,NULL),'querytype=Filter sdo_num_res=1')='TRUE'");
		      	        	      obj1.count++;
		      	        	      text.append("\nQuery"+obj1.count+":"+"select dbms_lob.substr(p.Points.Get_WKT(), 4000, 1 ) as coord from people1 p where sdo_filter(p.points,SDO_GEOMETRY(2003,NULL, NULL,SDO_ELEM_INFO_ARRAY(1,1003,4),SDO_ORDINATE_ARRAY("+xnew+","+(ynew-70)+","+(xnew+70)+","+ynew+","+xnew+","+(ynew+70)+")),'querytype=WINDOW')='TRUE' AND SDO_RELATE(p.points,SDO_GEOMETRY(2003,NULL, NULL,SDO_ELEM_INFO_ARRAY(1,1003,4),SDO_ORDINATE_ARRAY("+xnew+","+(ynew-70)+","+(xnew+70)+","+ynew+","+xnew+","+(ynew+70)+")),'mask = INSIDE+OVERLAPBDYINTERSECT querytype = WINDOW') = 'TRUE'");
		      	        	      obj1.count++;
		      	        	      text.append("\nQuery"+obj1.count+":"+"select dbms_lob.substr(p.Points.Get_WKT(), 4000, 1 ) as coord from people1 p where sdo_filter(p.points,SDO_GEOMETRY(2003,NULL, NULL,SDO_ELEM_INFO_ARRAY(1,1003,4),SDO_ORDINATE_ARRAY("+xnew+","+(ynew-70)+","+(xnew+70)+","+ynew+","+xnew+","+(ynew+70)+")),'querytype=WINDOW')='TRUE' AND SDO_RELATE(p.points,SDO_GEOMETRY(2003,NULL, NULL,SDO_ELEM_INFO_ARRAY(1,1003,4),SDO_ORDINATE_ARRAY("+xnew+","+(ynew-70)+","+(xnew+70)+","+ynew+","+xnew+","+(ynew+70)+")),'mask = INSIDE+OVERLAPBDYINTERSECT querytype = WINDOW') = 'TRUE'  intersect select dbms_lob.substr(p.Points.Get_WKT(), 4000, 1 ) as coord from people1 p where SDO_NN(p.points,sdo_geometry(2001, NULL, sdo_point_type("+xnew+","+ynew+",NULL), NULL,NULL),'querytype=Filter sdo_num_res=1',1)='TRUE'");
		      	        	      obj1.count++;
		      	              }
				 	    	 else if(CheckB.isSelected() & CheckB0.isSelected() & radio1.isSelected())
		    	    	      {

		    	    	    	  obj1.Active_Feature_Building_Point(g);
		   	        	          obj1.Active_Feature_AP_Point(g);
		   	        	          text.append("\nQuery"+obj1.count+":"+"select dbms_lob.substr(b.shape.Get_WKT(), 4000, 1 ) as coord,No_of_vertices from building b where sdo_filter(b.shape,SDO_GEOMETRY(2003,NULL, NULL,SDO_ELEM_INFO_ARRAY(1,1003,4),SDO_ORDINATE_ARRAY("+xnew+","+(ynew-70)+","+(xnew+70)+","+ynew+","+xnew+","+(ynew+70)+")),'querytype=WINDOW')='TRUE' AND SDO_RELATE(b.shape,SDO_GEOMETRY(2003,NULL, NULL,SDO_ELEM_INFO_ARRAY(1,1003,4),SDO_ORDINATE_ARRAY("+xnew+","+(ynew-70)+","+(xnew+70)+","+ynew+","+xnew+","+(ynew+70)+")),'mask = INSIDE+OVERLAPBDYINTERSECT querytype = WINDOW') = 'TRUE'");
		    	    			  obj1.count++;
		    	    			  text.append("\nQuery"+obj1.count+":"+"select dbms_lob.substr(b.shape.Get_WKT(), 4000, 1 ) as coord,No_Of_vertices from building b where sdo_filter(b.shape,SDO_GEOMETRY(2003,NULL, NULL,SDO_ELEM_INFO_ARRAY(1,1003,4),SDO_ORDINATE_ARRAY("+xnew+","+(ynew-70)+","+(xnew+70)+","+ynew+","+xnew+","+(ynew+70)+")),'querytype=WINDOW')='TRUE' AND SDO_RELATE(b.shape,SDO_GEOMETRY(2003,NULL, NULL,SDO_ELEM_INFO_ARRAY(1,1003,4),SDO_ORDINATE_ARRAY("+xnew+","+(ynew-70)+","+(xnew+70)+","+ynew+","+xnew+","+(ynew+70)+")),'mask = INSIDE+OVERLAPBDYINTERSECT querytype = WINDOW') = 'TRUE'  intersect select dbms_lob.substr(b.shape.Get_WKT(), 4000, 1 ) as coord,No_of_vertices from building b where SDO_NN(b.shape,sdo_geometry(2001, NULL, sdo_point_type("+xnew+","+ynew+",NULL), NULL,NULL),'querytype=Filter sdo_num_res=1')='TRUE'");
		      	        	      obj1.count++;
		      	        	      text.append("\nQuery"+obj1.count+":"+"select dbms_lob.substr(a.appoints.Get_WKT(), 4000, 1 ) as coord,radius from ap a where sdo_filter(a.appoints,SDO_GEOMETRY(2003,NULL, NULL,SDO_ELEM_INFO_ARRAY(1,1003,4),SDO_ORDINATE_ARRAY("+xnew+","+(ynew-70)+","+(xnew+70)+","+ynew+","+xnew+","+(ynew+70)+")),'querytype=WINDOW')='TRUE' AND SDO_RELATE(a.appoints,SDO_GEOMETRY(2003,NULL, NULL,SDO_ELEM_INFO_ARRAY(1,1003,4),SDO_ORDINATE_ARRAY("+xnew+","+(ynew-70)+","+(xnew+70)+","+ynew+","+xnew+","+(ynew+70)+")),'mask = INSIDE+OVERLAPBDYINTERSECT querytype = WINDOW') = 'TRUE'");
		      	        	      obj1.count++;
		      	        	      text.append("\nQuery"+obj1.count+":"+"select dbms_lob.substr(a.appoints.Get_WKT(), 4000, 1 ) as coord,radius from ap a where sdo_filter(a.appoints,SDO_GEOMETRY(2003,NULL, NULL,SDO_ELEM_INFO_ARRAY(1,1003,4),SDO_ORDINATE_ARRAY("+xnew+","+(ynew-70)+","+(xnew+70)+","+ynew+","+xnew+","+(ynew+70)+")),'querytype=WINDOW')='TRUE' AND SDO_RELATE(a.appoints,SDO_GEOMETRY(2003,NULL, NULL,SDO_ELEM_INFO_ARRAY(1,1003,4),SDO_ORDINATE_ARRAY("+xnew+","+(ynew-70)+","+(xnew+70)+","+ynew+","+xnew+","+(ynew+70)+")),'mask = INSIDE+OVERLAPBDYINTERSECT querytype = WINDOW') = 'TRUE' intersect (select dbms_lob.substr(a.appoints.Get_WKT(), 4000, 1 ) as coord,radius from ap a where SDO_NN(a.appoints,sdo_geometry(2001, NULL, sdo_point_type("+xnew+","+ynew+",NULL), NULL,NULL),'querytype=Filter sdo_num_res=1')='TRUE'");
		      	        	      obj1.count++;
		    	    	      }

		    	    	      else if(CheckB.isSelected() & CheckB1.isSelected() & radio1.isSelected())
		    	    	      {

		    	    	    	  obj1.Active_Feature_Building_Point(g);
		    	    	    	  obj1.Active_Feature_People_Point(g);
		    	    	    	  text.append("\nQuery"+obj1.count+":"+"select dbms_lob.substr(b.shape.Get_WKT(), 4000, 1 ) as coord,No_of_vertices from building b where sdo_filter(b.shape,SDO_GEOMETRY(2003,NULL, NULL,SDO_ELEM_INFO_ARRAY(1,1003,4),SDO_ORDINATE_ARRAY("+xnew+","+(ynew-70)+","+(xnew+70)+","+ynew+","+xnew+","+(ynew+70)+")),'querytype=WINDOW')='TRUE' AND SDO_RELATE(b.shape,SDO_GEOMETRY(2003,NULL, NULL,SDO_ELEM_INFO_ARRAY(1,1003,4),SDO_ORDINATE_ARRAY("+xnew+","+(ynew-70)+","+(xnew+70)+","+ynew+","+xnew+","+(ynew+70)+")),'mask = INSIDE+OVERLAPBDYINTERSECT querytype = WINDOW') = 'TRUE'");
		    	    			  obj1.count++;
		    	    			  text.append("\nQuery"+obj1.count+":"+"select dbms_lob.substr(b.shape.Get_WKT(), 4000, 1 ) as coord,No_Of_vertices from building b where sdo_filter(b.shape,SDO_GEOMETRY(2003,NULL, NULL,SDO_ELEM_INFO_ARRAY(1,1003,4),SDO_ORDINATE_ARRAY("+xnew+","+(ynew-70)+","+(xnew+70)+","+ynew+","+xnew+","+(ynew+70)+")),'querytype=WINDOW')='TRUE' AND SDO_RELATE(b.shape,SDO_GEOMETRY(2003,NULL, NULL,SDO_ELEM_INFO_ARRAY(1,1003,4),SDO_ORDINATE_ARRAY("+xnew+","+(ynew-70)+","+(xnew+70)+","+ynew+","+xnew+","+(ynew+70)+")),'mask = INSIDE+OVERLAPBDYINTERSECT querytype = WINDOW') = 'TRUE'  intersect select dbms_lob.substr(b.shape.Get_WKT(), 4000, 1 ) as coord,No_of_vertices from building b where SDO_NN(b.shape,sdo_geometry(2001, NULL, sdo_point_type("+xnew+","+ynew+",NULL), NULL,NULL),'querytype=Filter sdo_num_res=1')='TRUE'");
		      	        	      obj1.count++;
		      	        	      text.append("\nQuery"+obj1.count+":"+"select dbms_lob.substr(p.Points.Get_WKT(), 4000, 1 ) as coord from people1 p where sdo_filter(p.points,SDO_GEOMETRY(2003,NULL, NULL,SDO_ELEM_INFO_ARRAY(1,1003,4),SDO_ORDINATE_ARRAY("+xnew+","+(ynew-70)+","+(xnew+70)+","+ynew+","+xnew+","+(ynew+70)+")),'querytype=WINDOW')='TRUE' AND SDO_RELATE(p.points,SDO_GEOMETRY(2003,NULL, NULL,SDO_ELEM_INFO_ARRAY(1,1003,4),SDO_ORDINATE_ARRAY("+xnew+","+(ynew-70)+","+(xnew+70)+","+ynew+","+xnew+","+(ynew+70)+")),'mask = INSIDE+OVERLAPBDYINTERSECT querytype = WINDOW') = 'TRUE'");
		      	        	      obj1.count++;
		      	        	      text.append("\nQuery"+obj1.count+":"+"select dbms_lob.substr(p.Points.Get_WKT(), 4000, 1 ) as coord from people1 p where sdo_filter(p.points,SDO_GEOMETRY(2003,NULL, NULL,SDO_ELEM_INFO_ARRAY(1,1003,4),SDO_ORDINATE_ARRAY("+xnew+","+(ynew-70)+","+(xnew+70)+","+ynew+","+xnew+","+(ynew+70)+")),'querytype=WINDOW')='TRUE' AND SDO_RELATE(p.points,SDO_GEOMETRY(2003,NULL, NULL,SDO_ELEM_INFO_ARRAY(1,1003,4),SDO_ORDINATE_ARRAY("+xnew+","+(ynew-70)+","+(xnew+70)+","+ynew+","+xnew+","+(ynew+70)+")),'mask = INSIDE+OVERLAPBDYINTERSECT querytype = WINDOW') = 'TRUE'  intersect select dbms_lob.substr(p.Points.Get_WKT(), 4000, 1 ) as coord from people1 p where SDO_NN(p.points,sdo_geometry(2001, NULL, sdo_point_type("+xnew+","+ynew+",NULL), NULL,NULL),'querytype=Filter sdo_num_res=1',1)='TRUE'");
		      	        	      obj1.count++;
		    	    	      }

		    	              else if(CheckB0.isSelected() & CheckB1.isSelected() & radio1.isSelected())
		    	              {
		    	            	  obj1.Active_Feature_AP_Point(g);
		    	            	  obj1.Active_Feature_People_Point(g);
		    	            	  text.append("\nQuery"+obj1.count+":"+"select dbms_lob.substr(p.Points.Get_WKT(), 4000, 1 ) as coord from people1 p where sdo_filter(p.points,SDO_GEOMETRY(2003,NULL, NULL,SDO_ELEM_INFO_ARRAY(1,1003,4),SDO_ORDINATE_ARRAY("+xnew+","+(ynew-70)+","+(xnew+70)+","+ynew+","+xnew+","+(ynew+70)+")),'querytype=WINDOW')='TRUE' AND SDO_RELATE(p.points,SDO_GEOMETRY(2003,NULL, NULL,SDO_ELEM_INFO_ARRAY(1,1003,4),SDO_ORDINATE_ARRAY("+xnew+","+(ynew-70)+","+(xnew+70)+","+ynew+","+xnew+","+(ynew+70)+")),'mask = INSIDE+OVERLAPBDYINTERSECT querytype = WINDOW') = 'TRUE'");
		      	        	      obj1.count++;
		      	        	      text.append("\nQuery"+obj1.count+":"+"select dbms_lob.substr(p.Points.Get_WKT(), 4000, 1 ) as coord from people1 p where sdo_filter(p.points,SDO_GEOMETRY(2003,NULL, NULL,SDO_ELEM_INFO_ARRAY(1,1003,4),SDO_ORDINATE_ARRAY("+xnew+","+(ynew-70)+","+(xnew+70)+","+ynew+","+xnew+","+(ynew+70)+")),'querytype=WINDOW')='TRUE' AND SDO_RELATE(p.points,SDO_GEOMETRY(2003,NULL, NULL,SDO_ELEM_INFO_ARRAY(1,1003,4),SDO_ORDINATE_ARRAY("+xnew+","+(ynew-70)+","+(xnew+70)+","+ynew+","+xnew+","+(ynew+70)+")),'mask = INSIDE+OVERLAPBDYINTERSECT querytype = WINDOW') = 'TRUE'  intersect select dbms_lob.substr(p.Points.Get_WKT(), 4000, 1 ) as coord from people1 p where SDO_NN(p.points,sdo_geometry(2001, NULL, sdo_point_type("+xnew+","+ynew+",NULL), NULL,NULL),'querytype=Filter sdo_num_res=1',1)='TRUE'");
		      	        	      obj1.count++;
		      	        	      text.append("\nQuery"+obj1.count+":"+"select dbms_lob.substr(a.appoints.Get_WKT(), 4000, 1 ) as coord,radius from ap a where sdo_filter(a.appoints,SDO_GEOMETRY(2003,NULL, NULL,SDO_ELEM_INFO_ARRAY(1,1003,4),SDO_ORDINATE_ARRAY("+xnew+","+(ynew-70)+","+(xnew+70)+","+ynew+","+xnew+","+(ynew+70)+")),'querytype=WINDOW')='TRUE' AND SDO_RELATE(a.appoints,SDO_GEOMETRY(2003,NULL, NULL,SDO_ELEM_INFO_ARRAY(1,1003,4),SDO_ORDINATE_ARRAY("+xnew+","+(ynew-70)+","+(xnew+70)+","+ynew+","+xnew+","+(ynew+70)+")),'mask = INSIDE+OVERLAPBDYINTERSECT querytype = WINDOW') = 'TRUE'");
		      	        	      obj1.count++;
		      	        	      text.append("\nQuery"+obj1.count+":"+"select dbms_lob.substr(a.appoints.Get_WKT(), 4000, 1 ) as coord,radius from ap a where sdo_filter(a.appoints,SDO_GEOMETRY(2003,NULL, NULL,SDO_ELEM_INFO_ARRAY(1,1003,4),SDO_ORDINATE_ARRAY("+xnew+","+(ynew-70)+","+(xnew+70)+","+ynew+","+xnew+","+(ynew+70)+")),'querytype=WINDOW')='TRUE' AND SDO_RELATE(a.appoints,SDO_GEOMETRY(2003,NULL, NULL,SDO_ELEM_INFO_ARRAY(1,1003,4),SDO_ORDINATE_ARRAY("+xnew+","+(ynew-70)+","+(xnew+70)+","+ynew+","+xnew+","+(ynew+70)+")),'mask = INSIDE+OVERLAPBDYINTERSECT querytype = WINDOW') = 'TRUE' intersect (select dbms_lob.substr(a.appoints.Get_WKT(), 4000, 1 ) as coord,radius from ap a where SDO_NN(a.appoints,sdo_geometry(2001, NULL, sdo_point_type("+xnew+","+ynew+",NULL), NULL,NULL),'querytype=Filter sdo_num_res=1')='TRUE'");
		      	        	      obj1.count++;

		    	              }
		    	              else if(CheckB1.isSelected() & radio1.isSelected())
		    	              {
		    	            	  obj1.Active_Feature_People_Point(g);
		    	            	  text.append("\nQuery"+obj1.count+":"+"select dbms_lob.substr(p.Points.Get_WKT(), 4000, 1 ) as coord from people1 p where sdo_filter(p.points,SDO_GEOMETRY(2003,NULL, NULL,SDO_ELEM_INFO_ARRAY(1,1003,4),SDO_ORDINATE_ARRAY("+xnew+","+(ynew-70)+","+(xnew+70)+","+ynew+","+xnew+","+(ynew+70)+")),'querytype=WINDOW')='TRUE' AND SDO_RELATE(p.points,SDO_GEOMETRY(2003,NULL, NULL,SDO_ELEM_INFO_ARRAY(1,1003,4),SDO_ORDINATE_ARRAY("+xnew+","+(ynew-70)+","+(xnew+70)+","+ynew+","+xnew+","+(ynew+70)+")),'mask = INSIDE+OVERLAPBDYINTERSECT querytype = WINDOW') = 'TRUE'");
		      	        	      obj1.count++;
		      	        	      text.append("\nQuery"+obj1.count+":"+"select dbms_lob.substr(p.Points.Get_WKT(), 4000, 1 ) as coord from people1 p where sdo_filter(p.points,SDO_GEOMETRY(2003,NULL, NULL,SDO_ELEM_INFO_ARRAY(1,1003,4),SDO_ORDINATE_ARRAY("+xnew+","+(ynew-70)+","+(xnew+70)+","+ynew+","+xnew+","+(ynew+70)+")),'querytype=WINDOW')='TRUE' AND SDO_RELATE(p.points,SDO_GEOMETRY(2003,NULL, NULL,SDO_ELEM_INFO_ARRAY(1,1003,4),SDO_ORDINATE_ARRAY("+xnew+","+(ynew-70)+","+(xnew+70)+","+ynew+","+xnew+","+(ynew+70)+")),'mask = INSIDE+OVERLAPBDYINTERSECT querytype = WINDOW') = 'TRUE'  intersect select dbms_lob.substr(p.Points.Get_WKT(), 4000, 1 ) as coord from people1 p where SDO_NN(p.points,sdo_geometry(2001, NULL, sdo_point_type("+xnew+","+ynew+",NULL), NULL,NULL),'querytype=Filter sdo_num_res=1',1)='TRUE'");
		      	        	      obj1.count++;

		    	              }
		    	              else if(CheckB.isSelected() & radio1.isSelected() )
		    	    	      {

		    	    	    	  obj1.Active_Feature_Building_Point(g);
		    	    	    	  text.append("\nQuery"+obj1.count+":"+"select dbms_lob.substr(b.shape.Get_WKT(), 4000, 1 ) as coord,No_of_vertices from building b where sdo_filter(b.shape,SDO_GEOMETRY(2003,NULL, NULL,SDO_ELEM_INFO_ARRAY(1,1003,4),SDO_ORDINATE_ARRAY("+xnew+","+(ynew-70)+","+(xnew+70)+","+ynew+","+xnew+","+(ynew+70)+")),'querytype=WINDOW')='TRUE' AND SDO_RELATE(b.shape,SDO_GEOMETRY(2003,NULL, NULL,SDO_ELEM_INFO_ARRAY(1,1003,4),SDO_ORDINATE_ARRAY("+xnew+","+(ynew-70)+","+(xnew+70)+","+ynew+","+xnew+","+(ynew+70)+")),'mask = INSIDE+OVERLAPBDYINTERSECT querytype = WINDOW') = 'TRUE'");
		    	    			  obj1.count++;
		    	    			  text.append("\nQuery"+obj1.count+":"+"select dbms_lob.substr(b.shape.Get_WKT(), 4000, 1 ) as coord,No_Of_vertices from building b where sdo_filter(b.shape,SDO_GEOMETRY(2003,NULL, NULL,SDO_ELEM_INFO_ARRAY(1,1003,4),SDO_ORDINATE_ARRAY("+xnew+","+(ynew-70)+","+(xnew+70)+","+ynew+","+xnew+","+(ynew+70)+")),'querytype=WINDOW')='TRUE' AND SDO_RELATE(b.shape,SDO_GEOMETRY(2003,NULL, NULL,SDO_ELEM_INFO_ARRAY(1,1003,4),SDO_ORDINATE_ARRAY("+xnew+","+(ynew-70)+","+(xnew+70)+","+ynew+","+xnew+","+(ynew+70)+")),'mask = INSIDE+OVERLAPBDYINTERSECT querytype = WINDOW') = 'TRUE'  intersect select dbms_lob.substr(b.shape.Get_WKT(), 4000, 1 ) as coord,No_of_vertices from building b where SDO_NN(b.shape,sdo_geometry(2001, NULL, sdo_point_type("+xnew+","+ynew+",NULL), NULL,NULL),'querytype=Filter sdo_num_res=1')='TRUE'");
		      	        	      obj1.count++;
		    	    	      }
		    	              else if(CheckB0.isSelected() & radio1.isSelected())
		    	              {
		    	            	  obj1.Active_Feature_AP_Point(g);
		    	            	  text.append("\nQuery"+obj1.count+":"+"select dbms_lob.substr(a.appoints.Get_WKT(), 4000, 1 ) as coord,radius from ap a where sdo_filter(a.appoints,SDO_GEOMETRY(2003,NULL, NULL,SDO_ELEM_INFO_ARRAY(1,1003,4),SDO_ORDINATE_ARRAY("+xnew+","+(ynew-70)+","+(xnew+70)+","+ynew+","+xnew+","+(ynew+70)+")),'querytype=WINDOW')='TRUE' AND SDO_RELATE(a.appoints,SDO_GEOMETRY(2003,NULL, NULL,SDO_ELEM_INFO_ARRAY(1,1003,4),SDO_ORDINATE_ARRAY("+xnew+","+(ynew-70)+","+(xnew+70)+","+ynew+","+xnew+","+(ynew+70)+")),'mask = INSIDE+OVERLAPBDYINTERSECT querytype = WINDOW') = 'TRUE'");
		      	        	      obj1.count++;
		      	        	      text.append("\nQuery"+obj1.count+":"+"select dbms_lob.substr(a.appoints.Get_WKT(), 4000, 1 ) as coord,radius from ap a where sdo_filter(a.appoints,SDO_GEOMETRY(2003,NULL, NULL,SDO_ELEM_INFO_ARRAY(1,1003,4),SDO_ORDINATE_ARRAY("+xnew+","+(ynew-70)+","+(xnew+70)+","+ynew+","+xnew+","+(ynew+70)+")),'querytype=WINDOW')='TRUE' AND SDO_RELATE(a.appoints,SDO_GEOMETRY(2003,NULL, NULL,SDO_ELEM_INFO_ARRAY(1,1003,4),SDO_ORDINATE_ARRAY("+xnew+","+(ynew-70)+","+(xnew+70)+","+ynew+","+xnew+","+(ynew+70)+")),'mask = INSIDE+OVERLAPBDYINTERSECT querytype = WINDOW') = 'TRUE' intersect (select dbms_lob.substr(a.appoints.Get_WKT(), 4000, 1 ) as coord,radius from ap a where SDO_NN(a.appoints,sdo_geometry(2001, NULL, sdo_point_type("+xnew+","+ynew+",NULL), NULL,NULL),'querytype=Filter sdo_num_res=1')='TRUE'");
		      	        	      obj1.count++;

		    	              }


				         }
	    	      }
	      };

			 	       Button.addActionListener(actionListener3);
			 	       radio1.addActionListener(actionListener2);
				       radio1.addActionListener(actionListener3);
				       CheckB.addActionListener(actionListener3);
				       CheckB0.addActionListener(actionListener3);
				       CheckB1.addActionListener(actionListener3);
	    //   Button1.addActionListener(actionListener3);

	        ActionListener actionListener4 = new ActionListener()
		      {
		    	      public void actionPerformed(ActionEvent actionEvent4)
		    	      {
					 	     if(actionEvent4.getSource() == Button)
					         {
					 	    	 if(radio2.isSelected())
					 	    	 {



			    	    			  obj1.Active_Feature_AP_Covered_People(g);
			    	    			  text.append("\nQuery "+obj1.count+":"+"SELECT  dbms_lob.substr(p.points.Get_WKT(), 4000, 1 ) as coord FROM people1 p WHERE SDO_WITHIN_DISTANCE(p.points,sdo_geometry(2001, NULL, sdo_point_type("+xappoint[0]+","+yappoint[0]+",NULL), NULL,NULL), 'querytype=window distance="+nap[0]+"')='TRUE'");
			    	      			  obj1.count++;
			    	      			  text.append("\nQuery"+obj1.count+":"+"SELECT  dbms_lob.substr(p.points.Get_WKT(), 4000, 1 ) as coord FROM people1 p WHERE SDO_WITHIN_DISTANCE(p.points,sdo_geometry(2001, NULL, sdo_point_type("+xappoint[0]+","+yappoint[0]+",NULL), NULL,NULL), 'querytype=window distance = "+(nap[0]+5)+"')='TRUE' MINUS SELECT  dbms_lob.substr(p.points.Get_WKT(), 4000, 1 ) as coord FROM people1 p WHERE SDO_WITHIN_DISTANCE(p.points,sdo_geometry(2001, NULL, sdo_point_type("+xappoint[0]+","+yappoint[0]+",NULL), NULL,NULL), 'querytype=window distance = "+(nap[0])+"')='TRUE'");
			    	      			  obj1.count++;
			    	      			  text.append("\nQuery "+obj1.count+":"+"SELECT  dbms_lob.substr(p.points.Get_WKT(), 4000, 1 ) as coord FROM people1 p WHERE SDO_WITHIN_DISTANCE(p.points,sdo_geometry(2001, NULL, sdo_point_type("+xappoint[0]+","+yappoint[0]+",NULL), NULL,NULL), 'querytype=window distance = "+(nap[0]+10)+"')='TRUE' MINUS SELECT  dbms_lob.substr(p.points.Get_WKT(), 4000, 1 ) as coord FROM people1 p WHERE SDO_WITHIN_DISTANCE(p.points,sdo_geometry(2001, NULL, sdo_point_type("+xappoint[0]+","+yappoint[0]+",NULL), NULL,NULL), 'querytype=window distance = "+(nap[0]+5)+"')='TRUE' MINUS SELECT  dbms_lob.substr(p.points.Get_WKT(), 4000, 1 ) as coord FROM people1 p WHERE SDO_WITHIN_DISTANCE(p.points,sdo_geometry(2001, NULL, sdo_point_type("+xappoint[0]+","+yappoint[0]+",NULL), NULL,NULL), 'querytype=window distance = "+(nap[0])+"')='TRUE'");
			    	    			  obj1.count++;
					 	    	 }




					         }
		    	      }
		      };
		      ActionListener actionListener5 = new ActionListener()
		      {
		    	      public void actionPerformed(ActionEvent actionEvent5)
		     	      {
		    	    	  if(radio2.isSelected())
				 	    	 {
		    	    		  obj1.Active_Feature_Building(g);
	    	    			  obj1.Active_Feature_People(g);
	    	    			  obj1.Active_Feature_AP(g);
	    	    			  text.append("\nQuery"+obj1.count+":"+"select dbms_lob.substr(c.shape.Get_WKT(), 4000, 1 ) as coord,No_of_vertices from building c");
	    	    			  obj1.count++;
	    	    			  text.append("\nQuery"+obj1.count+":"+"select dbms_lob.substr(p.Points.Get_WKT(), 4000, 1 ) as coord from people1 p");
	    	    			  obj1.count++;
	    	    			  text.append("\nQuery"+obj1.count+":"+"select dbms_lob.substr(a.appoints.Get_WKT(), 4000, 1 ) as coord,radius from ap a");
	    	    			  obj1.count++;

		    	    	      obj1.mousePress1=true;

					         }
		    	      }
		      };

		      radio2.addActionListener(actionListener4);
		      radio2.addActionListener(actionListener5);
		      Button.addActionListener(actionListener4);

		      ActionListener actionListener6 = new ActionListener()
		      {
		    	      public void actionPerformed(ActionEvent actionEvent6)
		     	      {
		    	    	  if(radio0.isSelected())
				 	    	 {
		    	    	    obj1.mousePress2=true;

					         }
		    	      }
		      };



		      radio0.addActionListener(actionListener6);

		      ActionListener actionListener7 = new ActionListener()
		      {
		    	      public void actionPerformed(ActionEvent actionEvent7)
		    	      {
					 	     if(actionEvent7.getSource() == Button)
					         {
					 	    	 if(CheckB.isSelected() & CheckB0.isSelected() &  CheckB1.isSelected() & radio0.isSelected())
					 	    	 {
					 	    		    obj1.Buil=1;
					 	    		    obj1.Peop=1;
					 	    		    obj1.access=1;

					 	    		    obj1.Active_Feature_Rect(g);

					 	    		   // text.append("\nQuery"+ obj1.count + "");

			      	        	        text.append("\nQuery"+obj1.count+":"+"Select b.bname,dbms_lob.substr(b.shape.Get_WKT(), 4000, 1 ) as coord,No_of_vertices FROM Building B WHERE SDO_FILTER(B.shape,SDO_GEOMETRY(2003,NULL, NULL,SDO_ELEM_INFO_ARRAY(1,1003,3),SDO_ORDINATE_ARRAY("+ obj1.rect.x + "," + Math.abs(obj1.rect.y + obj1.rect.height) + "," + (obj1.rect.x+ obj1.rect.width) + "," + (obj1.rect.y ) + ")),'querytype=WINDOW')='TRUE' AND SDO_RELATE(B.shape,SDO_GEOMETRY(2003,NULL, NULL,SDO_ELEM_INFO_ARRAY(1,1003,3),SDO_ORDINATE_ARRAY("+ (obj1.rect.x) + "," + Math.abs(obj1.rect.y + obj1.rect.height) + "," + (obj1.rect.x+ obj1.rect.width) + "," + (obj1.rect.y ) + ")),'mask = INSIDE+OVERLAPBDYINTERSECT+CONTAINS querytype = WINDOW') = 'TRUE'");
			      	                    obj1.count++;
			      	                    text.append("\nQuery"+obj1.count+":"+"select dbms_lob.substr(p.Points.Get_WKT(), 4000, 1 ) as coord from people1 p WHERE SDO_FILTER(p.Points,SDO_GEOMETRY(2003,NULL, NULL,SDO_ELEM_INFO_ARRAY(1,1003,3),SDO_ORDINATE_ARRAY("+ obj1.rect.x + "," + Math.abs(obj1.rect.y + obj1.rect.height) + "," + (obj1.rect.x+ obj1.rect.width) + "," + (obj1.rect.y ) + ")),'querytype=WINDOW')='TRUE' AND SDO_RELATE(p.Points,SDO_GEOMETRY(2003,NULL, NULL,SDO_ELEM_INFO_ARRAY(1,1003,3),SDO_ORDINATE_ARRAY("+ (obj1.rect.x) + "," + Math.abs(obj1.rect.y + obj1.rect.height) + "," + (obj1.rect.x+ obj1.rect.width) + "," + (obj1.rect.y ) + ")),'mask = INSIDE+OVERLAPBDYINTERSECT+CONTAINS querytype = WINDOW') = 'TRUE'");
			      	                    obj1.count++;
			      	                    text.append("\nQuery"+obj1.count+":"+"select dbms_lob.substr(a.appoints.Get_WKT(), 4000, 1 ) as coord,radius from ap a WHERE SDO_FILTER(a.appoints,SDO_GEOMETRY(2003,NULL, NULL,SDO_ELEM_INFO_ARRAY(1,1003,3),SDO_ORDINATE_ARRAY("+ obj1.rect.x + "," + Math.abs(obj1.rect.y +obj1.rect.height) + "," + (obj1.rect.x+ obj1.rect.width) + "," + (obj1.rect.y ) + ")),'querytype=WINDOW')='TRUE' AND SDO_RELATE(a.appoints,SDO_GEOMETRY(2003,NULL, NULL,SDO_ELEM_INFO_ARRAY(1,1003,3),SDO_ORDINATE_ARRAY("+ (obj1.rect.x) + "," + Math.abs(obj1.rect.y + obj1.rect.height) + "," + (obj1.rect.x+ obj1.rect.width) + "," + (obj1.rect.y ) + ")),'mask = INSIDE+OVERLAPBDYINTERSECT+CONTAINS querytype = WINDOW') = 'TRUE'");
			      	                    obj1.count++;

					 	    	 }
					 	    	 else if(CheckB.isSelected() & CheckB0.isSelected() & radio0.isSelected())
			    	    	      {
						 	    		obj1.Buil=1;
					 	    		    obj1.access=1;
						 	    		obj1.Active_Feature_Rect(g);
						 	    		text.append("\nQuery"+obj1.count+":"+"Select b.bname,dbms_lob.substr(b.shape.Get_WKT(), 4000, 1 ) as coord,No_of_vertices FROM Building B WHERE SDO_FILTER(B.shape,SDO_GEOMETRY(2003,NULL, NULL,SDO_ELEM_INFO_ARRAY(1,1003,3),SDO_ORDINATE_ARRAY("+ obj1.rect.x + "," + Math.abs(obj1.rect.y + obj1.rect.height) + "," + (obj1.rect.x+ obj1.rect.width) + "," + (obj1.rect.y ) + ")),'querytype=WINDOW')='TRUE' AND SDO_RELATE(B.shape,SDO_GEOMETRY(2003,NULL, NULL,SDO_ELEM_INFO_ARRAY(1,1003,3),SDO_ORDINATE_ARRAY("+ (obj1.rect.x) + "," + Math.abs(obj1.rect.y + obj1.rect.height) + "," + (obj1.rect.x+ obj1.rect.width) + "," + (obj1.rect.y ) + ")),'mask = INSIDE+OVERLAPBDYINTERSECT+CONTAINS querytype = WINDOW') = 'TRUE'");
			      	                    obj1.count++;
			      	                    text.append("\nQuery"+obj1.count+":"+"select dbms_lob.substr(a.appoints.Get_WKT(), 4000, 1 ) as coord,radius from ap a WHERE SDO_FILTER(a.appoints,SDO_GEOMETRY(2003,NULL, NULL,SDO_ELEM_INFO_ARRAY(1,1003,3),SDO_ORDINATE_ARRAY("+ obj1.rect.x + "," + Math.abs(obj1.rect.y +obj1.rect.height) + "," + (obj1.rect.x+ obj1.rect.width) + "," + (obj1.rect.y ) + ")),'querytype=WINDOW')='TRUE' AND SDO_RELATE(a.appoints,SDO_GEOMETRY(2003,NULL, NULL,SDO_ELEM_INFO_ARRAY(1,1003,3),SDO_ORDINATE_ARRAY("+ (obj1.rect.x) + "," + Math.abs(obj1.rect.y + obj1.rect.height) + "," + (obj1.rect.x+ obj1.rect.width) + "," + (obj1.rect.y ) + ")),'mask = INSIDE+OVERLAPBDYINTERSECT+CONTAINS querytype = WINDOW') = 'TRUE'");
			      	                    obj1.count++;

			    	    	      }

			    	    	      else if(CheckB.isSelected() & CheckB1.isSelected() & radio0.isSelected())
			    	    	      {

			    	    	    	    obj1.Buil=1;
					 	    		    obj1.Peop=1;
						 	    		obj1.Active_Feature_Rect(g);
						 	    		text.append("\nQuery"+obj1.count+":"+"Select b.bname,dbms_lob.substr(b.shape.Get_WKT(), 4000, 1 ) as coord,No_of_vertices FROM Building B WHERE SDO_FILTER(B.shape,SDO_GEOMETRY(2003,NULL, NULL,SDO_ELEM_INFO_ARRAY(1,1003,3),SDO_ORDINATE_ARRAY("+ obj1.rect.x + "," + Math.abs(obj1.rect.y + obj1.rect.height) + "," + (obj1.rect.x+ obj1.rect.width) + "," + (obj1.rect.y ) + ")),'querytype=WINDOW')='TRUE' AND SDO_RELATE(B.shape,SDO_GEOMETRY(2003,NULL, NULL,SDO_ELEM_INFO_ARRAY(1,1003,3),SDO_ORDINATE_ARRAY("+ (obj1.rect.x) + "," + Math.abs(obj1.rect.y + obj1.rect.height) + "," + (obj1.rect.x+ obj1.rect.width) + "," + (obj1.rect.y ) + ")),'mask = INSIDE+OVERLAPBDYINTERSECT+CONTAINS querytype = WINDOW') = 'TRUE'");
			      	                    obj1.count++;
			      	                    text.append("\nQuery"+obj1.count+":"+"select dbms_lob.substr(p.Points.Get_WKT(), 4000, 1 ) as coord from people1 p WHERE SDO_FILTER(p.Points,SDO_GEOMETRY(2003,NULL, NULL,SDO_ELEM_INFO_ARRAY(1,1003,3),SDO_ORDINATE_ARRAY("+ obj1.rect.x + "," + Math.abs(obj1.rect.y + obj1.rect.height) + "," + (obj1.rect.x+ obj1.rect.width) + "," + (obj1.rect.y ) + ")),'querytype=WINDOW')='TRUE' AND SDO_RELATE(p.Points,SDO_GEOMETRY(2003,NULL, NULL,SDO_ELEM_INFO_ARRAY(1,1003,3),SDO_ORDINATE_ARRAY("+ (obj1.rect.x) + "," + Math.abs(obj1.rect.y + obj1.rect.height) + "," + (obj1.rect.x+ obj1.rect.width) + "," + (obj1.rect.y ) + ")),'mask = INSIDE+OVERLAPBDYINTERSECT+CONTAINS querytype = WINDOW') = 'TRUE'");
			      	                    obj1.count++;
				      	          }

			    	              else if(CheckB0.isSelected() & CheckB1.isSelected() & radio0.isSelected())
			    	              {
			    	            	    obj1.Peop=1;
					 	    		    obj1.access=1;
						 	    		obj1.Active_Feature_Rect(g);
						 	    		text.append("\nQuery"+obj1.count+":"+"select dbms_lob.substr(p.Points.Get_WKT(), 4000, 1 ) as coord from people1 p WHERE SDO_FILTER(p.Points,SDO_GEOMETRY(2003,NULL, NULL,SDO_ELEM_INFO_ARRAY(1,1003,3),SDO_ORDINATE_ARRAY("+ obj1.rect.x + "," + Math.abs(obj1.rect.y + obj1.rect.height) + "," + (obj1.rect.x+ obj1.rect.width) + "," + (obj1.rect.y ) + ")),'querytype=WINDOW')='TRUE' AND SDO_RELATE(p.Points,SDO_GEOMETRY(2003,NULL, NULL,SDO_ELEM_INFO_ARRAY(1,1003,3),SDO_ORDINATE_ARRAY("+ (obj1.rect.x) + "," + Math.abs(obj1.rect.y + obj1.rect.height) + "," + (obj1.rect.x+ obj1.rect.width) + "," + (obj1.rect.y ) + ")),'mask = INSIDE+OVERLAPBDYINTERSECT+CONTAINS querytype = WINDOW') = 'TRUE'");
			      	                    obj1.count++;
			      	                    text.append("\nQuery"+obj1.count+":"+"select dbms_lob.substr(a.appoints.Get_WKT(), 4000, 1 ) as coord,radius from ap a WHERE SDO_FILTER(a.appoints,SDO_GEOMETRY(2003,NULL, NULL,SDO_ELEM_INFO_ARRAY(1,1003,3),SDO_ORDINATE_ARRAY("+ obj1.rect.x + "," + Math.abs(obj1.rect.y +obj1.rect.height) + "," + (obj1.rect.x+ obj1.rect.width) + "," + (obj1.rect.y ) + ")),'querytype=WINDOW')='TRUE' AND SDO_RELATE(a.appoints,SDO_GEOMETRY(2003,NULL, NULL,SDO_ELEM_INFO_ARRAY(1,1003,3),SDO_ORDINATE_ARRAY("+ (obj1.rect.x) + "," + Math.abs(obj1.rect.y + obj1.rect.height) + "," + (obj1.rect.x+ obj1.rect.width) + "," + (obj1.rect.y ) + ")),'mask = INSIDE+OVERLAPBDYINTERSECT+CONTAINS querytype = WINDOW') = 'TRUE'");
			      	                    obj1.count++;
			    	              }
			    	              else if(CheckB1.isSelected() & radio0.isSelected())
			    	              {
			    	            	    obj1.Peop=1;
						 	    		obj1.Active_Feature_Rect(g);
						 	    		text.append("\nQuery"+obj1.count+":"+"select dbms_lob.substr(p.Points.Get_WKT(), 4000, 1 ) as coord from people1 p WHERE SDO_FILTER(p.Points,SDO_GEOMETRY(2003,NULL, NULL,SDO_ELEM_INFO_ARRAY(1,1003,3),SDO_ORDINATE_ARRAY("+ obj1.rect.x + "," + Math.abs(obj1.rect.y + obj1.rect.height) + "," + (obj1.rect.x+ obj1.rect.width) + "," + (obj1.rect.y ) + ")),'querytype=WINDOW')='TRUE' AND SDO_RELATE(p.Points,SDO_GEOMETRY(2003,NULL, NULL,SDO_ELEM_INFO_ARRAY(1,1003,3),SDO_ORDINATE_ARRAY("+ (obj1.rect.x) + "," + Math.abs(obj1.rect.y + obj1.rect.height) + "," + (obj1.rect.x+ obj1.rect.width) + "," + (obj1.rect.y ) + ")),'mask = INSIDE+OVERLAPBDYINTERSECT+CONTAINS querytype = WINDOW') = 'TRUE'");
			      	                    obj1.count++;
			    	              }
			    	              else if(CheckB.isSelected() & radio0.isSelected() )
			    	    	      {

			    	            	    obj1.Buil=1;
						 	    		obj1.Active_Feature_Rect(g);
						 	    		text.append("\nQuery"+obj1.count+":"+"Select b.bname,dbms_lob.substr(b.shape.Get_WKT(), 4000, 1 ) as coord,No_of_vertices FROM Building B WHERE SDO_FILTER(B.shape,SDO_GEOMETRY(2003,NULL, NULL,SDO_ELEM_INFO_ARRAY(1,1003,3),SDO_ORDINATE_ARRAY("+ obj1.rect.x + "," + Math.abs(obj1.rect.y + obj1.rect.height) + "," + (obj1.rect.x+ obj1.rect.width) + "," + (obj1.rect.y ) + ")),'querytype=WINDOW')='TRUE' AND SDO_RELATE(B.shape,SDO_GEOMETRY(2003,NULL, NULL,SDO_ELEM_INFO_ARRAY(1,1003,3),SDO_ORDINATE_ARRAY("+ (obj1.rect.x) + "," + Math.abs(obj1.rect.y + obj1.rect.height) + "," + (obj1.rect.x+ obj1.rect.width) + "," + (obj1.rect.y ) + ")),'mask = INSIDE+OVERLAPBDYINTERSECT+CONTAINS querytype = WINDOW') = 'TRUE'");
			      	                    obj1.count++;
			    	    	      }
			    	              else if(CheckB0.isSelected() & radio0.isSelected())
			    	              {
			    	            	    obj1.access=1;
						 	    		obj1.Active_Feature_Rect(g);
						 	    		text.append("\nQuery"+obj1.count+":"+"select dbms_lob.substr(a.appoints.Get_WKT(), 4000, 1 ) as coord,radius from ap a WHERE SDO_FILTER(a.appoints,SDO_GEOMETRY(2003,NULL, NULL,SDO_ELEM_INFO_ARRAY(1,1003,3),SDO_ORDINATE_ARRAY("+ obj1.rect.x + "," + Math.abs(obj1.rect.y +obj1.rect.height) + "," + (obj1.rect.x+ obj1.rect.width) + "," + (obj1.rect.y ) + ")),'querytype=WINDOW')='TRUE' AND SDO_RELATE(a.appoints,SDO_GEOMETRY(2003,NULL, NULL,SDO_ELEM_INFO_ARRAY(1,1003,3),SDO_ORDINATE_ARRAY("+ (obj1.rect.x) + "," + Math.abs(obj1.rect.y + obj1.rect.height) + "," + (obj1.rect.x+ obj1.rect.width) + "," + (obj1.rect.y ) + ")),'mask = INSIDE+OVERLAPBDYINTERSECT+CONTAINS querytype = WINDOW') = 'TRUE'");
			      	                    obj1.count++;
			    	              }


					         }
		    	      }
		      };


		      radio0.addActionListener(actionListener7);
		      Button.addActionListener(actionListener7);
		   f.addMouseMotionListener(new MouseMotionAdapter()
		   {

			   public void mouseDragged(MouseEvent e)
	    	      {

	    		     if(obj1.mousePress2)
	    	         {

	    		      obj1.drawing = true;
	    	          obj1.x = Math.min(obj1.mousePress4.x, e.getPoint().x);
	    	          obj1.y = Math.min(obj1.mousePress4.y,e.getPoint().y);
	    	          obj1.width = Math.abs(obj1.mousePress4.x - e.getPoint().x);
	    	          obj1.height = Math.abs(obj1.mousePress4.y - e.getPoint().y);
	    	          obj1.rect = new Rectangle(obj1.x, obj1.y, obj1.width, obj1.height);

	    	         }
	    		     obj1.repaint();
	    	      }



		   });
	       f.addMouseListener(new MouseAdapter()
	       {

	    	   public void mousePressed(MouseEvent e)
	    	   {
	    		   if(obj1.mousePress2)
	   		       {
		    		// System.out.println("HEllo");
	   		    	 obj1.mousePress4 = e.getPoint();
	   		    	// System.out.println(obj1.mousePress4.x);
	   		       }
	    	   }

	    	   public void mouseClicked(MouseEvent e)
	   	 	   {


	    		   if(obj1.MouseClick)
	   		      {
	   	    	   System.out.println("im in");
	   	 		   obj1.mouseClick = e.getPoint();
	   	 		   obj1.xnew = e.getPoint().x;
	   	 		   obj1.ynew = e.getPoint().y;
	   	 		   obj1. r = 1;
	   	 		   obj1.MouseClick = false;
	   		      }

	    			if(obj1.mousePress1)
	    			{
	    		    obj1.mousePress = e.getPoint();
	    		    obj1.a = e.getPoint().x;
	    		    obj1.b = e.getPoint().y;
	    			int valap=0,valapp=0;
	    		//	System.out.println("Fired");
	    			try
	    			{
	    			 Statement st4 = con.createStatement();
	    			 ResultSet rs4 ;
	    			 String lSQLstr4 ="";

	    	         lSQLstr4 ="SELECT  dbms_lob.substr(a.appoints.Get_WKT(), 4000, 1 ) as coord,radius FROM ap a WHERE SDO_NN(a.appoints, sdo_geometry(2001, NULL, sdo_point_type("+obj1.a+","+obj1.b+",NULL), NULL,NULL), 'querytype=window sdo_num_res=1')='TRUE'";
	    	         //System.out.println(lSQLstr4);
	    			 rs4= st4.executeQuery(lSQLstr4);

	    			 System.out.println("Hell0");

	    			while(rs4.next())
	    				{
	    			        // i2 = p2
	    					//System.out.println(rs4.getObject(1).toString());
	    					obj1.coordap[obj1.ap2] = rs4.getObject(1).toString();
	    					obj1.nap[obj1.ap2] = rs4.getInt("radius");
	    				//	System.out.println(rs4.getInt("radius"));
	    				  	//ap2 = ap2+1;

	    		         }

	    				for(int j2=0;j2<=obj1.ap2;j2++)
	    			    {

	    					obj1.x2ap[j2] = obj1.coordap[j2].replace("(", "");
	    			    	obj1.x2ap[j2] =  obj1.x2ap[j2].replace(")","");
	    			    	obj1.x2ap[j2] = obj1.x2ap[j2].replace("POINT","");
	    			    	obj1.x2apcount++;
	    			    //	System.out.println(x2ap[j2]);
	    			    }

	    				for(int j3=0;j3<obj1.x2apcount;j3++)
	    				{

	    					obj1.tempap = obj1.x2ap[j3].substring(1).split(" ");

	    					//System.out.println(tempap);

	    						obj1.xapp1[valap] = obj1.tempap[0].replace(".0","");
	    						obj1.yapp1[valap] = obj1.tempap[1].replace(".0","");
	    						valap++;
	    						obj1.cap = valap;



	    				}

	    				for (int i = 0; i < obj1.cap; i++)
	    				{
	    			    //System.out.println(xp1[i]);
	    			    int[] intarray = new int[obj1.cap];
	    				intarray[i] = Integer.parseInt(obj1.xapp1[i]);
	    				obj1.xappoint[i] = intarray[i];
	    				int intarray0[] = new int[obj1.cap];
	    				intarray0[i] = Integer.parseInt(obj1.yapp1[i]);
	    				obj1.yappoint[i] = intarray0[i];
	    				//System.out.println(xpoint[k]+","+ypoint[k]);
	    				System.out.println(obj1.xappoint[i]+","+obj1.yappoint[i]);

	    			    }
	    				obj1.ClickCount = 1;
	    				obj1.repaint();
	    			}catch(Exception ex){};


	    			System.out.println(obj1.mousePress1);
	    			obj1.mousePress1 = false;

	    			}

	    		}
	       });


	       f.setCursor(new Cursor(Cursor.TEXT_CURSOR));
	       p.setVisible(true);
	       f.setVisible(true);

	   }


	    public void clear()
	    {
	    	i2=0;
	    	app21=0;
	    	app22=0;
	    	p2 =0;
	    	p2BP=0;
	    	cpBP=0;
	    	x2pBPcount=0;
	    	x2app1count=0;
	    	x2pcount=0;
	    	cp=0;
	    	x2app2count=0;
	    	x2acount=0;
	    	ca=0;
	    	a2=0;
	    	c=0;
	    	x2count=0;
	    	i2BP=0;
	    	x2BPcount=0;
	    	cBP=0;
	    	caBP=0;
	    	a2BP=0;
	    	app2=0;
	    	x2appcount=0;
	    	cpsub2=0;
	    	cpsub1=0;
	    	p2BP=0;
	    	p2sub=0;
	    	p2sub1=0;
	    	p2sub2=0;
	    	x2psubcount2=0;
	    	x2psubcount=0;
	    	xnew=0;
	    	ynew=0;
	        r =0;
	        cap=0;
	        x2apcount=0;
	        x2BPacount=0;
	        x2psubcount1=0;
	        ClickCount=0;
	        cpsub=0;
	        x=0;
	        y=0;
	        width=0;
	        height=0;
	        capp=0;
	        rect=null;
	        Arrays.fill(xpoint,0);
	        Arrays.fill(ypoint,0);
	        Arrays.fill(xapoint,0);
	        Arrays.fill(yapoint,0);
	        Arrays.fill(xppoint,0);
	        Arrays.fill(yppoint,0);
	        Arrays.fill(xpointBP,0);
	        Arrays.fill(ypointBP,0);
	        Arrays.fill(xpointsub2, 0);
	        Arrays.fill(ypointsub2, 0);
	        Arrays.fill(xapointBP,0);
	        Arrays.fill(yapointBP,0);
	        Arrays.fill(xpointsub1,0);
	        Arrays.fill(ypointsub1,0);
	        Arrays.fill(xpointsub,0);
	        Arrays.fill(ypointsub,0);
	        Arrays.fill(xapppoint,0);
	        Arrays.fill(yapppoint,0);
	        Arrays.fill(xapppoint1,0);
	        Arrays.fill(yapppoint1,0);
	        Arrays.fill(xapppoint2,0);
	        Arrays.fill(yapppoint2,0);
	        Arrays.fill(xappoint,0);
	        Arrays.fill(yappoint,0);
	        Arrays.fill(xppointBP,0);
	        Arrays.fill(yppointBP,0);
	        repaint();

	    }


	    public void Active_Feature_Rect(Graphics g)
	    {

	    	 drawing = false;
	    	 int val =0;

	    	  if ((rect != null) )
	    	  {
	    		  System.out.println(rect.x +","+ rect.y +","+ rect.width +","+ rect.height);
	    		  int recp1x = rect.x;
	    		  int recp1y = (rect.y) - (rect.height);
	    		  int recp1x1 = (rect.x) + (rect.width);
	    		  int recp1y1 = rect.y;
	    		  System.out.println(recp1x+","+recp1y+","+recp1x1+","+recp1y1);

	    		  if(Buil == 1)
	    		  {
	    		  try
	    	 		{

	    	 	 	    Statement st2 = con.createStatement();
	    	 			ResultSet rs2 ;
	    	 			String lSQLstr ="";
	                    lSQLstr ="Select b.bname,dbms_lob.substr(b.shape.Get_WKT(), 4000, 1 ) as coord,No_of_vertices FROM Building B WHERE SDO_FILTER(B.shape,SDO_GEOMETRY(2003,NULL, NULL,SDO_ELEM_INFO_ARRAY(1,1003,3),SDO_ORDINATE_ARRAY("+ rect.x + "," + Math.abs(rect.y + rect.height) + "," + (rect.x+ rect.width) + "," + (rect.y ) + ")),'querytype=WINDOW')='TRUE' AND SDO_RELATE(B.shape,SDO_GEOMETRY(2003,NULL, NULL,SDO_ELEM_INFO_ARRAY(1,1003,3),SDO_ORDINATE_ARRAY("+ (rect.x) + "," + Math.abs(rect.y + rect.height) + "," + (rect.x+ rect.width) + "," + (rect.y ) + ")),'mask = INSIDE+OVERLAPBDYINTERSECT+CONTAINS querytype = WINDOW') = 'TRUE'";
	                     //System.out.println("1");
	                    //text.setText ("asdasd");
	                    //System.out.println("2");

	                   // System.out.println(lSQLstr);
	    	            rs2= st2.executeQuery(lSQLstr);
	    	           // text.append("\nQuery "+count+":"+lSQLstr );
		    			// count++;

	    	 		    while(rs2.next())
	    	 		    {

	    	 		    //	System.out.println(rs2.getObject(2).toString());
	    	 		    	coord[i2] = rs2.getObject(2).toString();
	    	 				n[i2] = rs2.getInt("No_of_vertices");
	    	 			  	i2 = i2+1;

	    	 		    }

	    	 		   for(int j2=0;j2<i2;j2++)
	    	 		    {

	    	 				x2[j2] = coord[j2].replace("(", "");
	    	 		    	x2[j2] =  x2[j2].replace(")","");
	    	 		    	x2[j2] = x2[j2].replace("POLYGON","");
	    	 		    	x2count++;
	    	 		    	//System.out.println(x2[j2]);
	    	 		    }

	    	 			for(int j3=0;j3<x2count;j3++)
	    	 			{

	    	 				temp = x2[j3].split(",");

	    	 				for(int j4=0;j4<temp.length;j4++)
	    	 				{
	    	 					temp2 = temp[j4].split(" ");
	    	 					xp1[val] = temp2[1].replace(".0","");
	    	 					//System.out.println(xp1[val]);
	    	 					yp1[val] = temp2[2].replace(".0","");
	    	 					val++;
	    	 					c = val;

	    	 				}

	    	 			}
	    	 			System.out.println(c);

	    	 			for (int i = 0; i < c; i++)
	    	 			{
	    	 		    //System.out.println(xp1[i]);
	    	 		    int[] intarray = new int[c];
	    	 			intarray[i] = Integer.parseInt(xp1[i]);
	    	 			//System.out.println(intarray[i]);
	    	 			xpoint[i] = intarray[i];
	    	 			int intarray0[] = new int[c];
	    	 			intarray0[i] = Integer.parseInt(yp1[i]);
	    	 			ypoint[i] = intarray0[i];
	    	 			//System.out.println(xpoint[k]+","+ypoint[k]);
	    	 			System.out.println(xpoint[i]+","+ypoint[i]);

	    	 		    }
	    	 		   Buil=0;
	    	 		}catch(Exception exception){};
	    		  }

	    	      if(Peop==1)
	    	      {
	    	 		int valp=0;
	    			   try
	    				{
	    			 	    Statement st = con.createStatement();
	    					ResultSet rs ;
	    					rs= st.executeQuery("select dbms_lob.substr(p.Points.Get_WKT(), 4000, 1 ) as coord from people1 p WHERE SDO_FILTER(p.Points,SDO_GEOMETRY(2003,NULL, NULL,SDO_ELEM_INFO_ARRAY(1,1003,3),SDO_ORDINATE_ARRAY("+ rect.x + "," + Math.abs(rect.y + rect.height) + "," + (rect.x+ rect.width) + "," + (rect.y ) + ")),'querytype=WINDOW')='TRUE' AND SDO_RELATE(p.Points,SDO_GEOMETRY(2003,NULL, NULL,SDO_ELEM_INFO_ARRAY(1,1003,3),SDO_ORDINATE_ARRAY("+ (rect.x) + "," + Math.abs(rect.y + rect.height) + "," + (rect.x+ rect.width) + "," + (rect.y ) + ")),'mask = INSIDE+OVERLAPBDYINTERSECT+CONTAINS querytype = WINDOW') = 'TRUE'");
	    							//st.executeUpdate("commit");
	    				//	text.append("\nQuery "+count+":"+"select dbms_lob.substr(p.Points.Get_WKT(), 4000, 1 ) as coord from people1 p WHERE SDO_FILTER(p.Points,SDO_GEOMETRY(2003,NULL, NULL,SDO_ELEM_INFO_ARRAY(1,1003,3),SDO_ORDINATE_ARRAY("+ rect.x + "," + Math.abs(rect.y + rect.height) + "," + (rect.x+ rect.width) + "," + (rect.y ) + ")),'querytype=WINDOW')='TRUE' AND SDO_RELATE(p.Points,SDO_GEOMETRY(2003,NULL, NULL,SDO_ELEM_INFO_ARRAY(1,1003,3),SDO_ORDINATE_ARRAY("+ (rect.x) + "," + Math.abs(rect.y + rect.height) + "," + (rect.x+ rect.width) + "," + (rect.y ) + ")),'mask = INSIDE+OVERLAPBDYINTERSECT+CONTAINS querytype = WINDOW') = 'TRUE'" );
	   	    			  //  count++;



	    			       while(rs.next())
	    				{
	    			        // i2 = p2
	    					//System.out.println(rs.getObject(1).toString());
	    					coordp[p2] = rs.getObject(1).toString();
	    					//np[p2] = rs.getInt("No_of_vertices");
	    				  	p2 = p2+1;

	    		         }

	    				for(int j2=0;j2<p2;j2++)
	    			    {

	    					x2p[j2] = coordp[j2].replace("(", "");
	    			    	x2p[j2] =  x2p[j2].replace(")","");
	    			    	x2p[j2] = x2p[j2].replace("POLYGON","");
	    			    	x2pcount++;
	    			    	//System.out.println(x2[j2]);
	    			    }

	    				for(int j3=0;j3<x2pcount;j3++)
	    				{

	    					tempp = x2p[j3].split(",");

	    					for(int j4=0;j4<tempp.length;j4++)
	    					{
	    						tempp2 = tempp[j4].split(" ");
	    						xpp1[valp] = tempp2[1].replace(".0","");
	    						ypp1[valp] = tempp2[2].replace(".0","");
	    						valp++;
	    						cp = valp;

	    					}


	    				}

	    				for (int i = 0; i < cp; i++)
	    				{

	    			    int[] intarray = new int[cp];
	    				intarray[i] = Integer.parseInt(xpp1[i]);

	    				xppoint[i] = intarray[i];
	    				int intarray0[] = new int[cp];
	    				intarray0[i] = Integer.parseInt(ypp1[i]);
	    				yppoint[i] = intarray0[i];
	    				//System.out.println(xppoint[i]+","+yppoint[i]);

	    			    }
                        Peop=0;
	    				}catch(Exception exception){};
	    	      }
                   if(access==1)
                   {
	    	 	 	try{
	    	 	 		int vala=0;
	    	 	 		Statement st3 = con.createStatement();
	    		 			ResultSet rs3 ;
	    		 			String lSQLstr3 ="";
	    	               lSQLstr3 ="select dbms_lob.substr(a.appoints.Get_WKT(), 4000, 1 ) as coord,radius from ap a WHERE SDO_FILTER(a.appoints,SDO_GEOMETRY(2003,NULL, NULL,SDO_ELEM_INFO_ARRAY(1,1003,3),SDO_ORDINATE_ARRAY("+ rect.x + "," + Math.abs(rect.y + rect.height) + "," + (rect.x+ rect.width) + "," + (rect.y ) + ")),'querytype=WINDOW')='TRUE' AND SDO_RELATE(a.appoints,SDO_GEOMETRY(2003,NULL, NULL,SDO_ELEM_INFO_ARRAY(1,1003,3),SDO_ORDINATE_ARRAY("+ (rect.x) + "," + Math.abs(rect.y + rect.height) + "," + (rect.x+ rect.width) + "," + (rect.y ) + ")),'mask = INSIDE+OVERLAPBDYINTERSECT+CONTAINS querytype = WINDOW') = 'TRUE'" ;
	    	               System.out.println(lSQLstr3);
	    		            rs3= st3.executeQuery(lSQLstr3);

	    		           // text.append("\nQuery "+count+":"+lSQLstr3 );
			    			// count++;
	    		 		    while(rs3.next())
	    		 		    {

	    		 		    	//System.out.println(rs3.getObject(1).toString());
	    		 		    	coorda[a2] = rs3.getObject(1).toString();
	    		 				na[i2] = rs3.getInt("radius");
	    		 			  	a2 = a2+1;

	    		 		    }

	    		 		   for(int j2=0;j2<a2;j2++)
	    		 		    {

	    		 				x2a[j2] = coorda[j2].replace("(", "");

	    		 		    	x2a[j2] =  x2a[j2].replace(")","");
	    		 		    	x2a[j2] = x2a[j2].replace("POINT","");
	    		 		    	x2acount++;
	    		 		    	//System.out.println(x2a[j2]);
	    		 		    }

	    		 			for(int j3=0;j3<x2acount;j3++)
	    		 			{

	    		 				tempa = x2a[j3].substring(1).split(" ");


	    		 					//tempa2 = tempa[j4].split(" ");
	    		 					xpa1[vala] = tempa[0].replace(".0","");
	    		 					//System.out.println(xpa1[vala]);
	    		 					ypa1[vala] = tempa[1].replace(".0","");
	    		 					vala++;
	    		 					ca = vala;





	    		 			}

	    		 			for (int i = 0; i < ca; i++)
	    		 			{
	    		 		    //System.out.println(xp1[i]);
	    		 		    int[] intarray = new int[ca];
	    		 			intarray[i] = Integer.parseInt(xpa1[i]);
	    		 			xapoint[i] = intarray[i];
	    		 			int intarray0[] = new int[ca];
	    		 			intarray0[i] = Integer.parseInt(ypa1[i]);
	    		 			yapoint[i] = intarray0[i];
	    		 			//System.out.println(xpoint[k]+","+ypoint[k]);
	    		 			// System.out.println(xapoint[i]+","+yapoint[i]);

	    		 		    }

					}catch(Exception exception){};
                     access=0;
                   }

	    	 	    }
	    	 Rectangle = 1;
	         repaint();


	    }
	    public void Active_Feature_Building(Graphics g)
	    {


	    	   int val=0;

	    	    try
	    		{

	    	 	    Statement st2 = con.createStatement();
	    			ResultSet rs2 ;
	    			rs2= st2.executeQuery("select dbms_lob.substr(c.shape.Get_WKT(), 4000, 1 ) as coord,No_of_vertices from building c");
	    			//text.append("\nQuery "+count+":"+"select dbms_lob.substr(c.shape.Get_WKT(), 4000, 1 ) as coord,No_of_vertices from building c" );
	    			 //count++;

	    			while(rs2.next())
	    			{

	    				System.out.println(rs2.getObject(1).toString());
	    				coord[i2] = rs2.getObject(1).toString();
	    				n[i2] = rs2.getInt("No_of_vertices");
	    			  	i2 = i2+1;

	    	         }

	    			for(int j2=0;j2<i2;j2++)
	    		    {

	    				x2[j2] = coord[j2].replace("(", "");
	    		    	x2[j2] =  x2[j2].replace(")","");
	    		    	x2[j2] = x2[j2].replace("POLYGON","");
	    		    	x2count++;
	    		    	//System.out.println(x2[j2]);
	    		    }

	    			for(int j3=0;j3<x2count;j3++)
	    			{

	    				temp = x2[j3].split(",");

	    				for(int j4=0;j4<temp.length;j4++)
	    				{
	    					temp2 = temp[j4].split(" ");
	    					xp1[val] = temp2[1].replace(".0","");
	    					yp1[val] = temp2[2].replace(".0","");
	    					val++;
	    					c = val;

	    				}


	    			}

	    			for (int i = 0; i < c; i++)
	    			{

	    		    int[] intarray = new int[c];
	    			intarray[i] = Integer.parseInt(xp1[i]);
	    			xpoint[i] = intarray[i];
	    			int intarray0[] = new int[c];
	    			intarray0[i] = Integer.parseInt(yp1[i]);
	    			ypoint[i] = intarray0[i];
	    			//System.out.println(xpoint[i]+","+ypoint[i]);
	    		    }

	    		}catch(Exception e){};
	    		//Building = true;
	    		ap_people=1;
	    		repaint();
	    }

	    public void Active_Feature_People(Graphics g)
	    {

	         int valp=0;
			   try
				{
			 	    Statement st = con.createStatement();
					ResultSet rs ;
					rs= st.executeQuery("select dbms_lob.substr(p.Points.Get_WKT(), 4000, 1 ) as coord from people1 p");
							//st.executeUpdate("commit");

					//text.append("\nQuery "+count+":"+"select dbms_lob.substr(p.Points.Get_WKT(), 4000, 1 ) as coord from people1 p");
	    			//count++;

			       while(rs.next())
				{
			        // i2 = p2
					//System.out.println(rs.getObject(1).toString());
					coordp[p2] = rs.getObject(1).toString();
					//np[p2] = rs.getInt("No_of_vertices");
				  	p2 = p2+1;

		         }

				for(int j2=0;j2<p2;j2++)
			    {

					x2p[j2] = coordp[j2].replace("(", "");
			    	x2p[j2] =  x2p[j2].replace(")","");
			    	x2p[j2] = x2p[j2].replace("POLYGON","");
			    	x2pcount++;
			    	//System.out.println(x2[j2]);
			    }

				for(int j3=0;j3<x2pcount;j3++)
				{

					tempp = x2p[j3].split(",");

					for(int j4=0;j4<tempp.length;j4++)
					{
						tempp2 = tempp[j4].split(" ");
						xpp1[valp] = tempp2[1].replace(".0","");
						ypp1[valp] = tempp2[2].replace(".0","");
						valp++;
						cp = valp;

					}


				}

				for (int i = 0; i < cp; i++)
				{
			    //System.out.println(xp1[i]);
			    int[] intarray = new int[cp];
				intarray[i] = Integer.parseInt(xpp1[i]);
				xppoint[i] = intarray[i];
				int intarray0[] = new int[cp];
				intarray0[i] = Integer.parseInt(ypp1[i]);
				yppoint[i] = intarray0[i];
				//System.out.println(xppoint[i]+","+yppoint[i]);

			    }

				}catch(Exception e){};
		       // People = true;
				ap_people=1;
				repaint();
	    }

	    public void Active_Feature_AP(Graphics g)
	    {
	    	int vala=0;

 	 		try
 	 		{
	    	    Statement st3 = con.createStatement();
	 			ResultSet rs3 ;
	 			String lSQLstr3 ="";
                lSQLstr3 ="select dbms_lob.substr(a.appoints.Get_WKT(), 4000, 1 ) as coord,radius from ap a " ;
	            rs3= st3.executeQuery(lSQLstr3);
	           // text.append("\nQuery "+count+":"+lSQLstr3 );
    			//count++;
	 		    while(rs3.next())
	 		    {


	 		    	coorda[a2] = rs3.getObject(1).toString();
	 				na[a2] = rs3.getInt("radius");
	 			//	System.out.println(na[a2]);
	 			  	a2 = a2+1;

	 		    }

	 		   for(int j2=0;j2<a2;j2++)
	 		    {

	 				x2a[j2] = coorda[j2].replace("(", "");

	 		    	x2a[j2] =  x2a[j2].replace(")","");
	 		    	x2a[j2] = x2a[j2].replace("POINT","");
	 		    	x2acount++;
	 		    //	System.out.println(x2a[j2]);
	 		    }

	 			for(int j3=0;j3<x2acount;j3++)
	 			{

	 				tempa = x2a[j3].substring(1).split(" ");


	 					//tempa2 = tempa[j4].split(" ");
	 					xpa1[vala] = tempa[0].replace(".0","");
	 					System.out.println(xpa1[vala]);
	 					ypa1[vala] = tempa[1].replace(".0","");
	 					vala++;
	 					ca = vala;





	 			}

	 			for (int i = 0; i < ca; i++)
	 			{
	 		    //System.out.println(xp1[i]);
	 		    int[] intarray = new int[ca];
	 			intarray[i] = Integer.parseInt(xpa1[i]);
	 			xapoint[i] = intarray[i];
	 			int intarray0[] = new int[ca];
	 			intarray0[i] = Integer.parseInt(ypa1[i]);
	 			yapoint[i] = intarray0[i];
	 			//System.out.println(xpoint[k]+","+ypoint[k]);
	 			// System.out.println(xapoint[i]+","+yapoint[i]);

	 		    }

 	 		}catch(Exception e){};

 	 		ap_people=1;
           repaint();
	    }

	    public void Active_Feature_Building_Point(Graphics g)
	    {
	    	    int valBP =0;
	    	    try
	    	    {
	    	    Statement st2 = con.createStatement();
	 			ResultSet rs2 ;
	 			String lSQLstr ="";
                lSQLstr ="select dbms_lob.substr(b.shape.Get_WKT(), 4000, 1 ) as coord,No_of_vertices from building b where sdo_filter(b.shape,SDO_GEOMETRY(2003,NULL, NULL,SDO_ELEM_INFO_ARRAY(1,1003,4),SDO_ORDINATE_ARRAY("+xnew+","+(ynew-70)+","+(xnew+70)+","+ynew+","+xnew+","+(ynew+70)+")),'querytype=WINDOW')='TRUE' AND SDO_RELATE(b.shape,SDO_GEOMETRY(2003,NULL, NULL,SDO_ELEM_INFO_ARRAY(1,1003,4),SDO_ORDINATE_ARRAY("+xnew+","+(ynew-70)+","+(xnew+70)+","+ynew+","+xnew+","+(ynew+70)+")),'mask = INSIDE+OVERLAPBDYINTERSECT querytype = WINDOW') = 'TRUE'";

                System.out.println(lSQLstr);
	            rs2= st2.executeQuery(lSQLstr);
	            //text.append("\nQuery "+count+":"+lSQLstr );
    			//count++;
	            while(rs2.next())
	 		    {

	 		    	//System.out.println(rs2.getObject(1).toString());
	 		    	coordBP[i2BP] = rs2.getObject(1).toString();
	 				nBP[i2BP] = rs2.getInt("No_of_vertices");
	 			  	i2BP = i2BP+1;

	 		    }

	 		   for(int j2=0;j2<i2BP;j2++)
	 		    {

	 				x2BP[j2] = coordBP[j2].replace("(", "");
	 		    	x2BP[j2] =  x2BP[j2].replace(")","");
	 		    	x2BP[j2] = x2BP[j2].replace("POLYGON","");
	 		    	x2BPcount++;
	 		    	//System.out.println(x2BP[j2]);
	 		    }

	 			for(int j3=0;j3<x2BPcount;j3++)
	 			{

	 				tempBP = x2BP[j3].split(",");
	 				//System.out.println(tempBP[0]+","+tempBP[1]);

	 				for(int j4=0;j4<tempBP.length;j4++)
	 				{
	 					temp2BP = tempBP[j4].split(" ");
	 					xp1BP[valBP] = temp2BP[1].replace(".0","");
	 					yp1BP[valBP] = temp2BP[2].replace(".0","");
	 					valBP++;
	 					cBP = valBP;
	 					//System.out.println(cBP);

	 				}


	 			}

	 			for (int i = 0; i < cBP; i++)
	 			{
	 		    //System.out.println(xp1[i]);
	 		    int[] intarrayBP = new int[cBP];
	 			intarrayBP[i] = Integer.parseInt(xp1BP[i]);
	 			xpointBP[i] = intarrayBP[i];
	 			int intarray0BP[] = new int[cBP];
	 			intarray0BP[i] = Integer.parseInt(yp1BP[i]);
	 			ypointBP[i] = intarray0BP[i];
	 			//System.out.println(xpoint[k]+","+ypoint[k]);
	 			//System.out.println(xpointBP[i]+","+ypointBP[i]);

	 		    }

	 			//Nearest Neighbor
	 			int valpsub2=0;
 			    Statement stsub0 = con.createStatement();
				ResultSet rssub ;
				String strquerysub;
				strquerysub = "select dbms_lob.substr(b.shape.Get_WKT(), 4000, 1 ) as coord,No_Of_vertices from building b where sdo_filter(b.shape,SDO_GEOMETRY(2003,NULL, NULL,SDO_ELEM_INFO_ARRAY(1,1003,4),SDO_ORDINATE_ARRAY("+xnew+","+(ynew-70)+","+(xnew+70)+","+ynew+","+xnew+","+(ynew+70)+")),'querytype=WINDOW')='TRUE' AND SDO_RELATE(b.shape,SDO_GEOMETRY(2003,NULL, NULL,SDO_ELEM_INFO_ARRAY(1,1003,4),SDO_ORDINATE_ARRAY("+xnew+","+(ynew-70)+","+(xnew+70)+","+ynew+","+xnew+","+(ynew+70)+")),'mask = INSIDE+OVERLAPBDYINTERSECT querytype = WINDOW') = 'TRUE'  intersect select dbms_lob.substr(b.shape.Get_WKT(), 4000, 1 ) as coord,No_of_vertices from building b where SDO_NN(b.shape,sdo_geometry(2001, NULL, sdo_point_type("+xnew+","+ynew+",NULL), NULL,NULL),'querytype=Filter sdo_num_res=1')='TRUE'";
                System.out.println(strquerysub);
				rssub= stsub0.executeQuery(strquerysub);
				//text.append("\nQuery "+count+":"+strquerysub );
    			//count++;


		       while(rssub.next())
			   {
		        // i2 = p2

				System.out.println(rssub.getObject(1).toString());
				coordsub2[p2sub2] = rssub.getObject(1).toString();
			    npsub2[p2sub2] = rssub.getInt("No_of_vertices");
			  	p2sub2 = p2sub2+1;

	           }

			for(int j2=0;j2<p2sub2;j2++)
		    {

				x2psub2[j2] = coordsub2[j2].replace("(", "");
		    	x2psub2[j2] =  x2psub2[j2].replace(")","");
		    	x2psub2[j2] = x2psub2[j2].replace("POINT","");
		    	x2psubcount2++;

		    }

			for(int j3=0;j3<x2psubcount2;j3++)
			{

				tempsub2 = x2psub2[j3].split(",");
			//	System.out.println(tempsub[0]+","+tempsub[1]);

 				for(int j4=0;j4<tempsub2.length;j4++)
 				{
 					temp2sub2 = tempsub2[j4].split(" ");
 					xp1sub2[valpsub2] = temp2sub2[1].replace(".0","");
 					yp1sub2[valpsub2] = temp2sub2[2].replace(".0","");
 					valpsub2++;
 					cpsub2 = valpsub2;
 					//System.out.println(cBP);

 				}


			}

			for (int i = 0; i < cpsub2; i++)
			{
		    //System.out.println(xp1[i]);
		    int[] intarray = new int[cpsub2];
			intarray[i] = Integer.parseInt(xp1sub2[i]);
			xpointsub2[i] = intarray[i];
			int intarray0[] = new int[cpsub2];
			intarray0[i] = Integer.parseInt(yp1sub2[i]);
			ypointsub2[i] = intarray0[i];
			//System.out.println(xpoint[k]+","+ypoint[k]);
			System.out.println(xpointsub2[i]+","+ypointsub2[i]);

		    }


	    	    }catch(Exception e){};
	    	    repaint();

	    }

	    public void Active_Feature_AP_Point(Graphics g)
	    {
	    	    int valaBP =0;
	    	    try
	    	    {
	               Statement st3 = con.createStatement();
			       ResultSet rs3 ;
			       String lSQLstr3 ="";
                   lSQLstr3 ="select dbms_lob.substr(a.appoints.Get_WKT(), 4000, 1 ) as coord,radius from ap a where sdo_filter(a.appoints,SDO_GEOMETRY(2003,NULL, NULL,SDO_ELEM_INFO_ARRAY(1,1003,4),SDO_ORDINATE_ARRAY("+xnew+","+(ynew-70)+","+(xnew+70)+","+ynew+","+xnew+","+(ynew+70)+")),'querytype=WINDOW')='TRUE' AND SDO_RELATE(a.appoints,SDO_GEOMETRY(2003,NULL, NULL,SDO_ELEM_INFO_ARRAY(1,1003,4),SDO_ORDINATE_ARRAY("+xnew+","+(ynew-70)+","+(xnew+70)+","+ynew+","+xnew+","+(ynew+70)+")),'mask = INSIDE+OVERLAPBDYINTERSECT querytype = WINDOW') = 'TRUE'";

                   System.out.println(lSQLstr3);
                   rs3= st3.executeQuery(lSQLstr3);
                   //text.append("\nQuery "+count+":"+lSQLstr3 );
       			   //count++;

			          while(rs3.next())
					    {

					    	//System.out.println(rs3.getObject(1).toString());
					    	coordaBP[a2BP] = rs3.getObject(1).toString();
							naBP[a2BP] = rs3.getInt("radius");
						  	a2BP = a2BP+1;

					    }

					   for(int j2=0;j2<a2BP;j2++)
					    {

							x2aBP[j2] = coordaBP[j2].replace("(", "");

					    	x2aBP[j2] =  x2aBP[j2].replace(")","");
					    	x2aBP[j2] = x2aBP[j2].replace("POINT","");
					    	x2BPacount++;
					    //	System.out.println(x2a[j2]);
					    }

						for(int j3=0;j3<x2BPacount;j3++)
						{

							tempaBP = x2aBP[j3].substring(1).split(" ");


								//tempa2 = tempa[j4].split(" ");
								xpa1BP[valaBP] = tempaBP[0].replace(".0","");
								System.out.println(xpa1[valaBP]);
								ypa1BP[valaBP] = tempaBP[1].replace(".0","");
								valaBP++;
								caBP = valaBP;





						}

						for (int i = 0; i < caBP; i++)
						{
					    //System.out.println(xp1[i]);
					    int[] intarray = new int[caBP];
						intarray[i] = Integer.parseInt(xpa1BP[i]);
						xapointBP[i] = intarray[i];
						int intarray0[] = new int[caBP];
						intarray0[i] = Integer.parseInt(ypa1BP[i]);
						yapointBP[i] = intarray0[i];
						//System.out.println(xpoint[k]+","+ypoint[k]);
						// System.out.println(xapoint[i]+","+yapoint[i]);

					    }

             //nearest neighbor
						int valpsub1=0;
		 			    Statement stsub0 = con.createStatement();
						ResultSet rssub ;
						String strquerysub;
						strquerysub = "select dbms_lob.substr(a.appoints.Get_WKT(), 4000, 1 ) as coord,radius from ap a where sdo_filter(a.appoints,SDO_GEOMETRY(2003,NULL, NULL,SDO_ELEM_INFO_ARRAY(1,1003,4),SDO_ORDINATE_ARRAY("+xnew+","+(ynew-70)+","+(xnew+70)+","+ynew+","+xnew+","+(ynew+70)+")),'querytype=WINDOW')='TRUE' AND SDO_RELATE(a.appoints,SDO_GEOMETRY(2003,NULL, NULL,SDO_ELEM_INFO_ARRAY(1,1003,4),SDO_ORDINATE_ARRAY("+xnew+","+(ynew-70)+","+(xnew+70)+","+ynew+","+xnew+","+(ynew+70)+")),'mask = INSIDE+OVERLAPBDYINTERSECT querytype = WINDOW') = 'TRUE' intersect (select dbms_lob.substr(a.appoints.Get_WKT(), 4000, 1 ) as coord,radius from ap a where SDO_NN(a.appoints,sdo_geometry(2001, NULL, sdo_point_type("+xnew+","+ynew+",NULL), NULL,NULL),'querytype=Filter sdo_num_res=1')='TRUE')";
		                System.out.println(strquerysub);
						rssub= stsub0.executeQuery(strquerysub);
						// text.append("\nQuery "+count+":"+strquerysub);
		       			 //  count++;



				       while(rssub.next())
					{
				        // i2 = p2

						System.out.println(rssub.getObject(1).toString());
						coordsub1[p2sub1] = rssub.getObject(1).toString();
						npsub1[p2sub1] = rssub.getInt("radius");
					  	p2sub1 = p2sub1+1;

			         }

					for(int j2=0;j2<p2sub1;j2++)
				    {

						x2psub1[j2] = coordsub1[j2].replace("(", "");
				    	x2psub1[j2] =  x2psub1[j2].replace(")","");
				    	x2psub1[j2] = x2psub1[j2].replace("POINT","");
				    	x2psubcount1++;

				    }

					for(int j3=0;j3<x2psubcount1;j3++)
					{

						tempsub1 = x2psub1[j3].split(" ");
					//	System.out.println(tempsub[0]+","+tempsub[1]);


							xp1sub1[valpsub1] = tempsub1[1].replace(".0","");
							yp1sub1[valpsub1] = tempsub1[2].replace(".0","");
							valpsub1++;
							cpsub1 = valpsub1;
							//System.out.println(xp1sub[valpsub]+","+yp1sub[valpsub]);



					}

					for (int i = 0; i < cpsub1; i++)
					{
				    //System.out.println(xp1[i]);
				    int[] intarray = new int[cpsub1];
					intarray[i] = Integer.parseInt(xp1sub1[i]);
					xpointsub1[i] = intarray[i];
					int intarray0[] = new int[cpsub1];
					intarray0[i] = Integer.parseInt(yp1sub1[i]);
					ypointsub1[i] = intarray0[i];
					//System.out.println(xpoint[k]+","+ypoint[k]);
					System.out.println(xpointsub1[i]+","+ypointsub1[i]);

				    }


		}catch(Exception exception){};

	    }
	    public void Active_Feature_People_Point(Graphics g)
	    {

	         int valpBP=0;
		     try
			 {
		 	    Statement st = con.createStatement();
				ResultSet rs ;
				String strquery;
				strquery = "select dbms_lob.substr(p.Points.Get_WKT(), 4000, 1 ) as coord from people1 p where sdo_filter(p.points,SDO_GEOMETRY(2003,NULL, NULL,SDO_ELEM_INFO_ARRAY(1,1003,4),SDO_ORDINATE_ARRAY("+xnew+","+(ynew-70)+","+(xnew+70)+","+ynew+","+xnew+","+(ynew+70)+")),'querytype=WINDOW')='TRUE' AND SDO_RELATE(p.points,SDO_GEOMETRY(2003,NULL, NULL,SDO_ELEM_INFO_ARRAY(1,1003,4),SDO_ORDINATE_ARRAY("+xnew+","+(ynew-70)+","+(xnew+70)+","+ynew+","+xnew+","+(ynew+70)+")),'mask = INSIDE+OVERLAPBDYINTERSECT querytype = WINDOW') = 'TRUE'";
                System.out.println(strquery);
				rs= st.executeQuery(strquery);
			//	text.append("\nQuery "+count+":"+strquery);
     		//	count++;



		       while(rs.next())
			{

				coordpBP[p2BP] = rs.getObject(1).toString();
			//	np[p2] = rs.getInt("No_of_vertices");
			  	p2BP = p2BP+1;

	         }

			for(int j2=0;j2<p2BP;j2++)
		    {

				x2pBP[j2] = coordpBP[j2].replace("(", "");
		    	x2pBP[j2] =  x2pBP[j2].replace(")","");
		    	x2pBP[j2] = x2pBP[j2].replace("POINT","");
		    	x2pBPcount++;
		    	//System.out.println(x2BP[j2]);
		    }

			for(int j3=0;j3<x2pBPcount;j3++)
			{

				temppBP = x2pBP[j3].split(" ");

					xpp1BP[valpBP] = temppBP[1].replace(".0","");
					ypp1BP[valpBP] = temppBP[2].replace(".0","");
					valpBP++;
					cpBP = valpBP;

			}

			for (int i = 0; i < cpBP; i++)
			{
		    //System.out.println(xp1[i]);
		    int[] intarray = new int[cpBP];
			intarray[i] = Integer.parseInt(xpp1BP[i]);
			xppointBP[i] = intarray[i];
			int intarray0[] = new int[cpBP];
			intarray0[i] = Integer.parseInt(ypp1BP[i]);
			yppointBP[i] = intarray0[i];
			//System.out.println(xpoint[k]+","+ypoint[k]);
			System.out.println(xppointBP[i]+","+yppointBP[i]);

		    }

			//nearest neighbor
                int valpsub=0;
 			    Statement stsub0 = con.createStatement();
				ResultSet rssub ;
				String strquerysub;
				strquerysub = "select dbms_lob.substr(p.Points.Get_WKT(), 4000, 1 ) as coord from people1 p where sdo_filter(p.points,SDO_GEOMETRY(2003,NULL, NULL,SDO_ELEM_INFO_ARRAY(1,1003,4),SDO_ORDINATE_ARRAY("+xnew+","+(ynew-70)+","+(xnew+70)+","+ynew+","+xnew+","+(ynew+70)+")),'querytype=WINDOW')='TRUE' AND SDO_RELATE(p.points,SDO_GEOMETRY(2003,NULL, NULL,SDO_ELEM_INFO_ARRAY(1,1003,4),SDO_ORDINATE_ARRAY("+xnew+","+(ynew-70)+","+(xnew+70)+","+ynew+","+xnew+","+(ynew+70)+")),'mask = INSIDE+OVERLAPBDYINTERSECT querytype = WINDOW') = 'TRUE'  intersect select dbms_lob.substr(p.Points.Get_WKT(), 4000, 1 ) as coord from people1 p where SDO_NN(p.points,sdo_geometry(2001, NULL, sdo_point_type("+xnew+","+ynew+",NULL), NULL,NULL),'querytype=Filter sdo_num_res=1',1)='TRUE'";
                System.out.println(strquerysub);
				rssub= stsub0.executeQuery(strquerysub);
				//text.append("\nQuery "+count+":"+strquerysub);
     			//count++;



		       while(rssub.next())
			   {

				System.out.println(rssub.getObject(1).toString());
				coordsub[p2sub] = rssub.getObject(1).toString();
			//	np[p2] = rs.getInt("No_of_vertices");
			  	p2sub = p2sub+1;

	           }

			for(int j2=0;j2<p2sub;j2++)
		    {

				x2psub[j2] = coordsub[j2].replace("(", "");
		    	x2psub[j2] =  x2psub[j2].replace(")","");
		    	x2psub[j2] = x2psub[j2].replace("POINT","");
		    	x2psubcount++;

		    }

			for(int j3=0;j3<x2psubcount;j3++)
			{

				tempsub = x2psub[j3].split(" ");
			//	System.out.println(tempsub[0]+","+tempsub[1]);


					xp1sub[valpsub] = tempsub[1].replace(".0","");
					yp1sub[valpsub] = tempsub[2].replace(".0","");
					valpsub++;
					cpsub = valpsub;
					//System.out.println(xp1sub[valpsub]+","+yp1sub[valpsub]);



			}

			for (int i = 0; i < cpsub; i++)
			{
		    //System.out.println(xp1[i]);
		    int[] intarray = new int[cpsub];
			intarray[i] = Integer.parseInt(xp1sub[i]);
			xpointsub[i] = intarray[i];
			int intarray0[] = new int[cpsub];
			intarray0[i] = Integer.parseInt(yp1sub[i]);
			ypointsub[i] = intarray0[i];
			//System.out.println(xpoint[k]+","+ypoint[k]);
			System.out.println(xpointsub[i]+","+ypointsub[i]);

		    }

		}catch(Exception ex){};
	}

	    public void Active_Feature_AP_Covered_People(Graphics g)
	    {
	    	 int valapp=0,valapp1=0,valapp2=0;
	    	 try {
		    	 Statement st4 = con.createStatement();
		    	 ResultSet rs5 ;
				 String lSQLstr5 ="";

		         lSQLstr5 ="SELECT  dbms_lob.substr(p.points.Get_WKT(), 4000, 1 ) as coord FROM people1 p WHERE SDO_WITHIN_DISTANCE(p.points,sdo_geometry(2001, NULL, sdo_point_type("+xappoint[0]+","+yappoint[0]+",NULL), NULL,NULL), 'querytype=window distance="+nap[0]+"')='TRUE'";
		         System.out.println(lSQLstr5);

				 rs5= st4.executeQuery(lSQLstr5);
				 //text=new JTextArea (5,100);
				// System.out.println(text);
				//text.append("\nQuery "+count+":"+"SELECT  dbms_lob.substr(p.points.Get_WKT(), 4000, 1 ) as coord FROM people1 p WHERE SDO_WITHIN_DISTANCE(p.points,sdo_geometry(2001, NULL, sdo_point_type("+xappoint[0]+","+yappoint[0]+",NULL), NULL,NULL), 'querytype=window distance="+nap[0]+"')='TRUE'");
     			// count++;


				while(rs5.next())
				{
			        // i2 = p2
					//System.out.println("AP"+rs5.getObject(1).toString());
					coordapp[app2] = rs5.getObject(1).toString();
					//nap[app2] = rs5.getInt("radius");
					//System.out.println(rs5.getInt("radius"));
				  	app2 = app2+1;

		         }

				for(int j2=0;j2<app2;j2++)
			    {

					x2app[j2] = coordapp[j2].replace("(", "");
			    	x2app[j2] =  x2app[j2].replace(")","");
			    	x2app[j2] = x2app[j2].replace("POINT","");
			    	x2appcount++;
			    	//System.out.println(x2app[j2]);

			    }

				for(int j3=0;j3<x2appcount;j3++)
				{

					tempapp = x2app[j3].substring(1).split(" ");



						xappp1[valapp] = tempapp[0].replace(".0","");
						yappp1[valapp] = tempapp[1].replace(".0","");
						valapp++;
						capp = valapp;
					//	System.out.println(xappp1[valapp]);


				}

				for (int i = 0; i < capp; i++)
				{
					//System.out.println("hi");
			    int[] intarray = new int[capp];
				intarray[i] = Integer.parseInt(xappp1[i]);
				xapppoint[i] = intarray[i];
				int intarray0[] = new int[capp];
				intarray0[i] = Integer.parseInt(yappp1[i]);
				yapppoint[i] = intarray0[i];
				//System.out.println(xpoint[k]+","+ypoint[k]);
				//System.out.println(xapppoint[i]+","+yapppoint[i]);

			    }
				    ResultSet rs6 ;
				    String lSQLstr6 ="";
			        lSQLstr6 ="SELECT  dbms_lob.substr(p.points.Get_WKT(), 4000, 1 ) as coord FROM people1 p WHERE SDO_WITHIN_DISTANCE(p.points,sdo_geometry(2001, NULL, sdo_point_type("+xappoint[0]+","+yappoint[0]+",NULL), NULL,NULL), 'querytype=window distance = "+(nap[0]+5)+"')='TRUE' MINUS SELECT  dbms_lob.substr(p.points.Get_WKT(), 4000, 1 ) as coord FROM people1 p WHERE SDO_WITHIN_DISTANCE(p.points,sdo_geometry(2001, NULL, sdo_point_type("+xappoint[0]+","+yappoint[0]+",NULL), NULL,NULL), 'querytype=window distance = "+(nap[0])+"')='TRUE'";
			        System.out.println(lSQLstr6);
					rs6= st4.executeQuery(lSQLstr6);
				//	text.append("\nQuery "+count+":"+lSQLstr6);
	     			// count++;
					while(rs6.next())
					{
				        // i2 = p2
						//System.out.println(rs5.getObject(1).toString());
						coordapp1[app21] = rs6.getObject(1).toString();
						//nap[app2] = rs5.getInt("radius");
						//System.out.println(rs5.getInt("radius"));
					  	app21 = app21+1;

			         }

					for(int j2=0;j2<app21;j2++)
				    {

						x2app1[j2] = coordapp1[j2].replace("(", "");
				    	x2app1[j2] =  x2app1[j2].replace(")","");
				    	x2app1[j2] = x2app1[j2].replace("POINT","");
				    	x2app1count++;
				    	//System.out.println(x2app[j2]);

				    }

					for(int j3=0;j3<x2app1count;j3++)
					{

						tempapp1 = x2app1[j3].substring(1).split(" ");



							xappp11[valapp1] = tempapp1[0].replace(".0","");
							yappp11[valapp1] = tempapp1[1].replace(".0","");
							valapp1++;
							capp1 = valapp1;
						//	System.out.println(xappp1[valapp]);


					}

					for (int i = 0; i < capp1; i++)
					{
						//System.out.println("hi");
				    int[] intarray = new int[capp1];
					intarray[i] = Integer.parseInt(xappp11[i]);
					xapppoint1[i] = intarray[i];
					int intarray0[] = new int[capp1];
					intarray0[i] = Integer.parseInt(yappp11[i]);
					yapppoint1[i] = intarray0[i];
					//System.out.println(xpoint[k]+","+ypoint[k]);
					System.out.println(xapppoint1[i]+","+yapppoint1[i]);

				    }

					ResultSet rs7 ;
				    String lSQLstr7 ="";
			        lSQLstr7 ="SELECT  dbms_lob.substr(p.points.Get_WKT(), 4000, 1 ) as coord FROM people1 p WHERE SDO_WITHIN_DISTANCE(p.points,sdo_geometry(2001, NULL, sdo_point_type("+xappoint[0]+","+yappoint[0]+",NULL), NULL,NULL), 'querytype=window distance = "+(nap[0]+10)+"')='TRUE' MINUS SELECT  dbms_lob.substr(p.points.Get_WKT(), 4000, 1 ) as coord FROM people1 p WHERE SDO_WITHIN_DISTANCE(p.points,sdo_geometry(2001, NULL, sdo_point_type("+xappoint[0]+","+yappoint[0]+",NULL), NULL,NULL), 'querytype=window distance = "+(nap[0]+5)+"')='TRUE' MINUS SELECT  dbms_lob.substr(p.points.Get_WKT(), 4000, 1 ) as coord FROM people1 p WHERE SDO_WITHIN_DISTANCE(p.points,sdo_geometry(2001, NULL, sdo_point_type("+xappoint[0]+","+yappoint[0]+",NULL), NULL,NULL), 'querytype=window distance = "+(nap[0])+"')='TRUE'";
			        System.out.println(lSQLstr7);
					rs7= st4.executeQuery(lSQLstr7);
					//text.append("\nQuery "+count+":"+lSQLstr7);
	     			//count++;
					while(rs7.next())
					{
				        // i2 = p2
						//System.out.println(rs5.getObject(1).toString());
						coordapp2[app22] = rs7.getObject(1).toString();
						//nap[app2] = rs5.getInt("radius");
						//System.out.println(rs5.getInt("radius"));
					  	app22 = app22+1;

			         }

					for(int j2=0;j2<app22;j2++)
				    {

						x2app2[j2] = coordapp2[j2].replace("(", "");
				    	x2app2[j2] =  x2app2[j2].replace(")","");
				    	x2app2[j2] = x2app2[j2].replace("POINT","");
				    	x2app2count++;
				    	//System.out.println(x2app[j2]);

				    }

					for(int j3=0;j3<x2app2count;j3++)
					{

						tempapp2 = x2app2[j3].substring(1).split(" ");



							xappp12[valapp2] = tempapp2[0].replace(".0","");
							yappp12[valapp2] = tempapp2[1].replace(".0","");
							valapp2++;
							capp2 = valapp2;
						//	System.out.println(xappp1[valapp]);


					}

					for (int i = 0; i < capp2; i++)
					{
						//System.out.println("hi");
				    int[] intarray = new int[capp2];
					intarray[i] = Integer.parseInt(xappp12[i]);
					xapppoint2[i] = intarray[i];
					int intarray0[] = new int[capp2];
					intarray0[i] = Integer.parseInt(yappp12[i]);
					yapppoint2[i] = intarray0[i];
					//System.out.println(xpoint[k]+","+ypoint[k]);
					//System.out.println(xapppoint2[i]+","+yapppoint2[i]);

				    }

	    	 } catch (SQLException e) {

					e.printStackTrace();
				}
				repaint();


	    }
	   protected void paintComponent(Graphics g)
	   {

	      Graphics2D g2 = (Graphics2D)g;
	      if (image != null)
	      {
	         g.drawImage(image, 0, 0, null);
	      }

	     	//Active_Feature - Building

	        if(ap_people==1)
	        {
	          int rid =0;
	          for(int arrid=0; arrid <= i2-1; arrid++)
	  		 {
	  			int[] Xpoints = new int[n[arrid]];
	  			int[] Ypoints = new int[n[arrid]];
	          	for(int varrid=0; varrid < n[arrid]; varrid++)
	     		 	{
	          		Xpoints[varrid] = xpoint[rid] ;
	          		Ypoints[varrid] = ypoint[rid] ;
	          		rid = rid +1;

	     		 	}

	          	g.setColor(Color.YELLOW);
	          	g.drawPolygon(Xpoints,Ypoints,n[arrid]);
	  		 }

	          //Active_Feature - AP

	          for(int j1=0;j1<=(a2-1);j1++)
	   		  {

	       		  g.setColor(Color.red);
	       		  g.drawRect(xapoint[j1], yapoint[j1],15,15);
	       		  g.setColor(Color.red);
 		    	  g.fillOval(xapoint[j1]-5,yapoint[j1]-5,10,10);
 		    	  g.drawOval(xapoint[j1]-na[j1],yapoint[j1]-na[j1],(2*na[j1]),(2*na[j1]));

	   		   }

	         //Active_Feature - People
	          for(int j5=0;j5<(p2-1);j5++)
	 		  {
	         	g.setColor(Color.GREEN);
	         	g.drawRect(xppoint[j5], yppoint[j5],10,10);
	 		  }
	         // ap_people=0;
	        }

	         //Point Query
	           if(r == 1)
	           {
	        	      g.setColor(Color.red);
	 		    	  g.drawRect(xnew-5,ynew-5,5,5);
	 		    	  g.drawOval(xnew-70,ynew-70,140,140);

	        	      int rid1 =0;
	 		          for(int arrid1=0; arrid1 < i2BP; arrid1++)
	 		  		 {

		        	   // System.out.println(nBP[arrid1]);
	 		        	int[] Xpoints1 = new int[nBP[arrid1]];
	 		  			int[] Ypoints1 = new int[nBP[arrid1]];
	 		          	for(int varrid1=0; varrid1 < nBP[arrid1]; varrid1++)

	 		     		 	{
	 		          		Xpoints1[varrid1] = xpointBP[rid1] ;
	 		          		Ypoints1[varrid1] = ypointBP[rid1] ;
	 		          		rid1 = rid1 +1;

	 		     		 	}

	 		          	g.setColor(Color.green);
	 		          	g.drawPolygon(Xpoints1,Ypoints1,nBP[arrid1]);
	 		  		 }

	 		         int rid2 =0;
	 		          for(int arrid2=0; arrid2 < p2sub2; arrid2++)
	 		  		 {

		        	   // System.out.println(nBP[arrid1]);
	 		        	int[] Xpoints2 = new int[npsub2[arrid2]];
	 		  			int[] Ypoints2 = new int[npsub2[arrid2]];
	 		          	for(int varrid2=0; varrid2 < npsub2[arrid2]; varrid2++)

	 		     		 	{
	 		          		Xpoints2[varrid2] = xpointsub2[rid2] ;
	 		          		Ypoints2[varrid2] = ypointsub2[rid2] ;
	 		          		rid2 = rid2 +1;

	 		     		 	}

	 		          	g.setColor(Color.yellow);
	 		          	g.drawPolygon(Xpoints2,Ypoints2,npsub2[arrid2]);
	 		  		 }


	 		         for(int j2=0;j2<(a2BP);j2++)
	 		   		  {

	 		       		  g.setColor(Color.green);
	 		       		  g.drawRect(xapointBP[j2], yapointBP[j2],15,15);
	 		       		  g.setColor(Color.green);
	 	 		    	  g.fillOval(xapointBP[j2]-5,yapointBP[j2]-5,10,10);
	 	 		    	  g.drawOval(xapointBP[j2]-naBP[j2],yapointBP[j2]-naBP[j2],(2*naBP[j2]),(2*naBP[j2]));

	 		   		   }
	 		        for(int jsub1=0;jsub1<(p2sub1);jsub1++)
	 		 		 {

	 		 			 g.setColor(Color.yellow);
	 		       		  g.drawRect(xpointsub1[jsub1], ypointsub1[jsub1],15,15);
	 		       		  g.setColor(Color.yellow);
	 	 		    	  g.fillOval(xpointsub1[jsub1]-5,ypointsub1[jsub1]-5,10,10);
	 	 		    	  g.drawOval(xpointsub1[jsub1]-npsub1[jsub1],ypointsub1[jsub1]-npsub1[jsub1],(2*npsub1[jsub1]),(2*npsub1[jsub1]));


	 		 		 }

	 		        for(int j6=0;j6<=(p2BP-1);j6++)
	 		 		  {
	 		         	g.setColor(Color.GREEN);
	 		         	g.drawRect(xppointBP[j6], yppointBP[j6],10,10);
	 		 		  }
	 		       for(int jsub=0;jsub<(p2sub);jsub++)
	 		 		 {

	 	 		    	 g.setColor(Color.yellow);
	 		 			 g.drawRect(xpointsub[jsub], ypointsub[jsub],10,10);

	 		 		 }

	           }
	           if(ClickCount == 1)
	           {
	             for(int j16=0;j16<=(ap2);j16++)
			 		 {

			    		 g.setColor(Color.blue);
			 			 g.drawRect(xappoint[j16], yappoint[j16],15,15);

			 	    }


	           }

	         //Ap covered people
		    	 for(int j6=0;j6<(app2);j6++)
		 		 {

		    		 g.setColor(Color.green);
		 			 g.drawRect(xapppoint[j6], yapppoint[j6],10,10);

		 		 }

		    	 for(int j7=0;j7<(app2);j7++)
		 		 {
		    		 g.setColor(Color.yellow);
		    		 g.drawLine(xappoint[ap2],yappoint[ap2],xapppoint[j7],yapppoint[j7]);

		 		 }
		    	 //ap covered people radius 5
		    	 for(int j9=0;j9<(app21);j9++)
		 		 {

		    		 g.setColor(Color.green);
		 			 g.drawRect(xapppoint1[j9], yapppoint1[j9],10,10);
		 			 System.out.println(xapppoint1);
		 		 }
		    	 for(int j8=0;j8<(app21);j8++)
		 		 {

		    		 g.setColor(Color.blue);
		    		 g.drawLine(xappoint[ap2],yappoint[ap2],xapppoint1[j8],yapppoint1[j8]);

		 		 }

		    	 //within radius 10
		    	 for(int j10=0;j10<(app22);j10++)
		 		 {

		    		 g.setColor(Color.green);
		 			 g.drawRect(xapppoint2[j10], yapppoint2[j10],10,10);

		 		 }
		    	 for(int j11=0;j11<(app22);j11++)
		 		 {

		    		 g.setColor(Color.cyan);
		    		 g.drawLine(xappoint[ap2],yappoint[ap2],xapppoint2[j11],yapppoint2[j11]);

		 		 }
		    	//Range Query

		    	 if (rect == null)
		         {
		            return;
		         }
		         else if (drawing)
		         {
		            g2.setColor(DRAWING_RECT_COLOR);
		            g2.draw(rect);
		         }
		         else
		         {
		            g2.setColor(DRAWN_RECT_COLOR);
		            g2.draw(rect);
		         }

		    	if(Rectangle == 1)
		    	{
		    		int rid =0;
			          for(int arrid=0; arrid <= i2-1; arrid++)
			  		 {
			  			int[] Xpoints = new int[n[arrid]];
			  			int[] Ypoints = new int[n[arrid]];
			          	for(int varrid=0; varrid < n[arrid]; varrid++)
			     		 	{
			          		Xpoints[varrid] = xpoint[rid] ;
			          		Ypoints[varrid] = ypoint[rid] ;
			          		rid = rid +1;

			     		 	}

			          	g.setColor(Color.YELLOW);
			          	g.drawPolygon(Xpoints,Ypoints,n[arrid]);
			  		 }

			          for(int j5=0;j5<(p2-1);j5++)
			 		  {
			         	g.setColor(Color.GREEN);
			         	g.drawRect(xppoint[j5], yppoint[j5],10,10);
			 		  }

			          for(int j1=0;j1<=(a2-1);j1++)
			   		  {

			       		  g.setColor(Color.red);
			       		  g.drawRect(xapoint[j1], yapoint[j1],15,15);
			       		  g.setColor(Color.red);
		 		    	  g.fillOval(xapoint[j1]-5,yapoint[j1]-5,10,10);
		 		    	  g.drawOval(xapoint[j1]-na[j1],yapoint[j1]-na[j1],(2*na[j1]),(2*na[j1]));

			   		   }



		    	}

	   }

}

class MouseLabel extends JComponent
{
  public int x;
  public int y;
  int pointx1;
  int pointy1;

  public MouseLabel() {
    this.setBackground(Color.blue);
  }

 protected void paintComponent(Graphics g)
  {

    String s = x + ", " + y;
    g.setColor(Color.CYAN);
    g.drawString(s, x, y);
   // g.drawRect(pointx1,pointy1,5,5);


  }

}

