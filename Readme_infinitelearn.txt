INFINITE LEARN
#All in One library system

For this project to run in the system, 
XAMPP server should be installed
The project folder must be saved in htdocs folder in XAMPP folder

Description

In Infinite learn, user can search for various topics such as Data structures and Algorithms,CSS, Javascript, Software Engineering and many more. 
The educational materials such as E-Books, Websites and Video materials will be displayed according to user's searched topic. The most popular i.e., highet rated materials will be shown first followed by other materials. Based on user's search, the recommended materials will be shown  and users can explore the content. Users who prefer books in hard copies can add them to their cart and can set the number of books by their will. After User confirms the items in cart, He/she can proceed to payment part , where user needs to select the mode of payment and enter the valid credentials in the selected mode. A verification mail will be sent to the user's registered Email id and user will have to enter the OTP to complete the transaction. If the transaction is successfull, the user can proceed to delivery and choose the destination for book delivery. 
Now the user has ordered the books, he/she can either logout or continue to explore the website content.


------------MODIFICATIONS TO BE DONE---------
To use the email feature, we should do modifications in php.ini and sendmail.ini 
To Make changes and Updates please refer the below link: 
	https://www.youtube.com/watch?v=9W644cyDyNM
Here, we have created a general email for our project which is used by the Administrator, you can change the email id and make sure you change it in code also!!
If you want use our Generalised email, Please make changes in php.ini and sendmail.ini to this mail id and password!
	Email:    infinitelearn123@gmail.com
	Password: Infinitelearn 
Please Import the login.sql file into the localserver phpmyadmin to access our database and to import it create a database called login and import the tables in login database!!!.

-----------FLOW OF THE PROJECT-----------------
Start with index.php 
To sign in click on "sign in" on top right to navigate to Login page (Login.php)

For first time users, click on "sign up" to navigate to Signup page (Signup.php)

After entering valid credentials, the user enters main page (Ha.php).
He/she can search for topics, view the search results and explore the content available in the search results. 

User can view search history, delete search history, add books to cart, delete cart.

After finalising the cart, the user can proceed to payment by clicking on "payment" on the top nav bar. User can select either credit card (card.php) or netbanking (banklogin.php). 

If user chooses credit card, He/she should enter the card credentials and then verification mail will be sent where the user can find the OTP and he/she can enter the OTP. after successfull transaction user will be navigated to delivery page (Delivery.php)

Sample testcase:
Card name: TestUser
Card no: 123412341234
Card CVV: 123
Email id: Your Email id

If user chooses net banking, He/she should enter the bank credentials and then verification mail will be sent where the user can find the OTP and he/she can enter the OTP. after successfull transaction user will be navigated to delivery page (Delivery.php)

Sample testcase:

Bank login id: Your email id
Password: Your password in sign up page

In delivery page, user can select the house, find the shortest path along with delivery cost. 

Then user can log out of this session by clicking "Logout" button.  


     
 

 

      






 
