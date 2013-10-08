xquery version "1.0";
for $x in doc("Product.xml")/ProductInformation/Product
where $x/Condition= 'New' 
return  <Title>{data($x/Title)}</Title>