#### Query Parameters for Pagination
> **offset**: The position in the users list to begin at.  
**limit**: How many users to return. Maximum is 100.  
**orderby**: What field to sort by in the format &#60;fieldName&#62;|&#60;direction&#62;, i.e. firstName|asc to sort by first name alphabetically.  
**filter**: A urlencoded json object containing a query specification that will filter the users list. It's basically a data structure defining where clauses to apply to a database query.  
(See how to format the filter parameter below)

>**Filter Format:**  
	{"(fieldName | or | and)+":"value"} where value can be a value like a user's first name, or it can be a collection of sub filters. So the sub filters can be nested.  
>> **Examples:**  
* Find users whose first name is "Jason"  
	{"firstName":"Jason"}<br />  
*  Find users whose first name is "Jason" and whose last name is "Gordon"  
	{"firstName":"Jason","lastName":"Gordon"}<br />  
*  Find users whose first name is either "Jason" or "Mike"  
  {"or":{"firstName":"Jason","firstName":"Mike"}}  <-- The "OR" method. This is an example of nesting. We could have used "and" instead of or  
  here as well. This nesting of sub filters can be deep/complex as you need it to be.<br />  
  {"firsName":["Jason","Mike"]} <-- The "IN" method, notice it's an array.<br />  
*  Find users whose first name is NOT "Jason"  
  {"firstName":"!Jason"} <-- Notice the '!', which specifies not<br />  
*  Find users whose birth date is NULL  
  {"birthDate":"null"} <-- The word null is spelled out. I'll note that that the not operator (!) can be used here too!  
 			
