Create Database IF NOT EXISTS ShoppingCart;


CREATE TABLE IF NOT EXISTS Categories(
  Name varchar(20) NOT NULL PRIMARY KEY,
  Description varchar(50) NOT NULL,
  Tax decimal(10,0),PRIMARY KEY (Name));

CREATE TABLE IF NOT EXISTS Products(
  Product_Name varchar(20) NOT NULL PRIMARY KEY,
  Description varchar(50) NOT NULL,
  Price INT NOT NULL,
  Discount decimal(10,0),
  Category_Name varchar(20) NOT NULL,
  FOREIGN KEY (Category_Name) REFERENCES Categories(Name));

CREATE TABLE IF NOT EXISTS Cart(
  Customer_Name varchar(20) NOT NULL,
  Product_Name varchar(20) NOT NULL,
  Total INT,
  Total_Discount decimal(10,0),
  Total_With_Discount INT,
  Total_Tax INT,
  Total_With_Tax INT,
  Grand_Total Int,
  FOREIGN KEY (Product_Name) REFERENCES Products(Product_Name));







INSERT INTO Categories values('Shoes',"Sports Shoes",10.0);
INSERT INTO Categories values('Mobile',"SmartPhones",25);
INSERT INTO Categories values('Laptops',"Lenovo Laptops",18.5);
INSERT INTO Categories values('Shirts',"Levis PeterEngland Shirts",10.0);
INSERT INTO Categories values('Bottle',"Milton Water Bottles",5.0);



INSERT INTO Products values("Adidas","Adidas Running Sports Shoes",4200,20,"Shoes");
INSERT INTO Products values("Puma","Puma Sneakers",2300,10,"Shoes");
INSERT INTO Products values("Reebok","Reebok Running Sports Shoes",5500,15,"Shoes");
INSERT INTO Products values("Nike","Trekking Shoes",4000,5,"Shoes");

INSERT INTO Products values("Samsung","Samsung Note 4",14500,10,"Mobile");
INSERT INTO Products values("Mototrola","Moto G6 Plus",21000,15,"Mobile");
INSERT INTO Products values("Nokia","Nokia Guru",5000,10,"Mobile");
INSERT INTO Products values("Xiomi","Redmi Note4",11500,20,"Mobile");


INSERT INTO Products values("Lenovo","Lenovo G580 Laptop",45000,5,"Laptops");
INSERT INTO Products values("HP","HP Pavillion Laptop",25000,1,"Laptops");
INSERT INTO Products values("Dell","Dell Inspire Laptop",55000,20,"Laptops");

INSERT INTO Products values("LeeCooper","T-Shirts For Mens",1500,10,"Shirts");
INSERT INTO Products values("PeterEngland","Formal Shirt For Men",2000,5,"Shirts");
INSERT INTO Products values("Levis","Slim Party Wear SHirt for Men",35000,30,"Shirts");

INSERT INTO Products values("MiltonBlue","Milton Water bottle in Blue Colour",200,0,"Bottle");
INSERT INTO Products values("MiltonRed","Milton Water bottle in Red Colour",350,10,"Bottle");


INSERT INTO Cart values("Vaibhav","Adidas",4200,840,3360,420,3780,3780);
INSERT INTO Cart values("Vaibhav","LeeCooper",1500,150,1350,150,1500,5280);
INSERT INTO Cart values("Vaibhav","MiltonRed",350,35,315,35,350,5630);
INSERT INTO Cart values("Vaibhav","Motorola",21000,3150,17850,5250,23100,28730);