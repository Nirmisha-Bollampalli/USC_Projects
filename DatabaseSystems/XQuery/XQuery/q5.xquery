xquery version "1.0";
for $p in distinct-values(doc("review.xml")//Review/ProductTitle)
let $items := doc("review.xml")//Review[ProductTitle = $p]/Rating
order by avg($items) descending
return <Product  ProductTitle="{$p}"
                         AverageReviewRating="{avg($items)}"
                      />

