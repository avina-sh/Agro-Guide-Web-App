# Agro-Guide-Web-App
Workflow:
Firstly, there are two buttons on the home page each for customers and farmers. 
Based on the choice they are redirected to the respective login page.
The customer login details are stored in the consumer login table and the farmer login details are stored in the users table.
The passwords are encrypted using the MD5 algorithm.
The farmer after logging in enters all information like phone_no, crop, and land_area. 
The details along with the username get stored in the farmer details table.
There is an after-insert trigger used here, the trigger is used to store the crop and username in the product table. 
There is a button harvest completed on the page. Upon clicking it, the farmer is supposed to enter his crop quantity and price. 
It gets updated in the product table respectively.
The quantity of each crop is summed up and stored in the warehouse table. 
Now when the consumer logs in and places an order for a particular crop, he enters the crop name and quantity. 
First, it checks whether the desired quantity is available in the warehouse.
If the desired quantity of a crop is not available in the warehouse, the system informs the consumer that the requested quantity is not available at the moment. 
They can then choose to adjust their order quantity or select a different crop.
If it is available. then it goes to the product table. and for each farmer, it calculates the desired price for their quantity of crop and gives them their price. 
The price is updated in the farmer_acc table, along with the customer name and farmer name. 
After purchase, the quantity gets decreased in the warehouse table.
Now for crop suggestions, the farmers have a button to indicate the desired crop.
It is obtained by creating a view on the farmer details table and finding the crop with the minimum land area.

HOW TO RUN:
* Install xampp in your system
* Import the database
* Extract these files and place them in htdocs folder in xampp
* Start the apache and mysql server in xampp
* In browser type: localhost/xampp/your_folder_name
