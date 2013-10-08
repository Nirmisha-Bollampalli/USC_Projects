xquery version "1.0";
distinct-values (
for $y in doc("review.xml")/ReviewInformation/Review
let $x := doc("product.xml")/ProductInformation/Product[Title = $y/ProductTitle]
where  $x/Price > 10 and $x/Production_Date[Month > 8]
order by $y/Reviewer descending
return ($y/Reviewer)
)