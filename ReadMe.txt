**************(make sure to use the last version!!)*************
( some parts have been change including the nav.php,contactus and sign up form and ...)

Iteration 1&2:

1)shopingcart should be added automaticly for each user at sign up time

2)Search and Filter on Items

3)(Implementing Payment is for NEXT iteration) After the customer drag and drops items in "itemsInShoppingCart?" then they have to have an option to select the branch location, date and time for delivery.thier info after confirmation will be added to "order" table: 
the branch ID,
 date and time and,receiptID(shoppingcart belonging to the user) ,totalPrice will be saved in the "order" table


4)website should work on at least 3 browsers

5)need a system logo

6)Technical Report

Issues:

1) MaintainDB nav_admin => the admin looses the access after viewing aboutUs/contactUs/Home pages

2) MaintainDB nav_admin => check the address is should work from all pages

3) we should make sure the username at the sign up time is unique
****it does NOT save the user if the username is not unique. => insertForm.php


5) the dropdown menu in delete.php doesn't work for some reason. it works in other pages! => maybe put all the pages related to admin to one folder

7)delete.php=> does not show the first users


TO DO:
- access to certain pages available only to logged in users (Sina) => DONE
- different navs based on logged in user: customer vs admin (Sina) => DONE
- logout (Sina) => DONE
- alert boxes for login (Sina: will do by Sunday March 19)
- create payment view (next it)
- add payment to database - next it(Sina)