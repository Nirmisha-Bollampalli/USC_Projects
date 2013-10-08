xquery version "1.0";

distinct-values (
for $y in doc("review.xml")/ReviewInformation/Review
let $x := doc("product.xml")/ProductInformation/Product[Title = $y/ProductTitle]
where  $y/ReviewDate[Month = 9 ]
return  ($x/Title)
)