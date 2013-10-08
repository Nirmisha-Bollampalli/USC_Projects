<?xml version="1.0" encoding="iso-8859-1"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance">
<xsl:output method="html" encoding="iso-8859-1" doctype-public="-//W3C//DTD XHTML 1.0 Transitional//EN" doctype-system="http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"/>
<xsl:template match="/">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"/>
<title>Review Information</title>
</head>

<body>
<table border="1" bgcolor="#0099FF" style="font-family:Times">
      <tr>
        <th>ReviewNumber</th>
        <th>ProductTitle</th>
        <th>Rating</th>
        <th>Reviewer</th>
         <th>ReviewerDate</th>
         <th>ReviewerDescription</th>
        
		
      </tr>
      <xsl:for-each select="ReviewInformation/Review">
      <tr>
	   	<td><xsl:value-of select="ReviewNumber"/></td>
	   	<td><xsl:value-of select="ProductTitle"/></td>
        <td><xsl:value-of select="Rating"/></td>
        <td><xsl:value-of select="Reviewer"/></td>
        <td><xsl:value-of select="ReviewDate"/></td>
        <td><xsl:value-of select="Month"/></td>
        <td><xsl:value-of select="Day"/></td>
        <td><xsl:value-of select="Year"/></td>
		<td><xsl:value-of select="ReviewDescription"/></td>
	  </tr>
	  </xsl:for-each>
 </table>
</body>
</html>

</xsl:template>
</xsl:stylesheet>