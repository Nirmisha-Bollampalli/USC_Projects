create table building(bid varchar(20),bname varchar(30),No_of_Vertices integer,shape MDSYS.sdo_geometry);
INSERT INTO user_sdo_geom_metadata
    (TABLE_NAME,
     COLUMN_NAME,
     DIMINFO,
     SRID)
  VALUES (
  'building',
  'shape',
  SDO_DIM_ARRAY(   -- 20X20 grid
    SDO_DIM_ELEMENT('X', 0, 800, 0.2),
    SDO_DIM_ELEMENT('Y', 0, 650, 0.2)
     ),
  NULL -- SRID
);


CREATE INDEX building_spatial_index
   ON building(shape)
   INDEXTYPE IS MDSYS.SPATIAL_INDEX;
   

create table people1(pid varchar(20),Points MDSYS.sdo_geometry);

INSERT INTO user_sdo_geom_metadata
    (TABLE_NAME,
     COLUMN_NAME,
     DIMINFO,
     SRID)
  VALUES (
  'people1',
  'Points',
  SDO_DIM_ARRAY(   -- 20X20 grid
    SDO_DIM_ELEMENT('X', 0, 800, 0.2),
    SDO_DIM_ELEMENT('Y', 0, 650, 0.2)
     ),
  NULL -- SRID
);   


CREATE INDEX people1_spatial_index
   ON people1(Points)
   INDEXTYPE IS MDSYS.SPATIAL_INDEX;
   

CREATE TABLE ap(aid varchar(30),appoints MDSYS.sdo_geometry,radius integer);


INSERT INTO user_sdo_geom_metadata
    (TABLE_NAME,
     COLUMN_NAME,
     DIMINFO,
     SRID)
  VALUES (
  'ap',
  'appoints',
  SDO_DIM_ARRAY(   -- 20X20 grid
    SDO_DIM_ELEMENT('X', 0, 800, 0.2),
    SDO_DIM_ELEMENT('Y', 0, 650, 0.2)
     ),
  NULL -- SRID
);  

CREATE INDEX ap_spatial_index
   ON ap(appoints)
   INDEXTYPE IS MDSYS.SPATIAL_INDEX;
      



