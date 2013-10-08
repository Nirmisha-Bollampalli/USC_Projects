xquery version "1.0";
for $p in distinct-values(doc("review.xml")//Review/ProductTitle)
let $items := doc("review.xml")//Review[ProductTitle = $p]/ReviewNumber
order by count($items)
return <Product  ProductTitle="{$p}"
                        ReviewCount="{count($items)}"
                      />

