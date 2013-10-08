xquery version "1.0";
distinct-values (
for $y in doc("review.xml")/ReviewInformation/Review
let $x := doc("product.xml")/ProductInformation/Product[Title = $y/ProductTitle]
where  $y/Rating>3
return (concat($x/Title ,
            $x/Condition))
          )