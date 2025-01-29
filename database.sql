-- Create Customer table
CREATE TABLE Customer (
    CustomerID INT PRIMARY KEY AUTO_INCREMENT,
    Username VARCHAR(50) UNIQUE,
    Password VARCHAR(255),
    Name VARCHAR(255),
    Email VARCHAR(255),
    Phone VARCHAR(20),
  
);

-- Create Trip table
CREATE TABLE Trip (
    TripID INT PRIMARY KEY AUTO_INCREMENT,
    Destination VARCHAR(255),
    DepartureDate DATE,
    ReturnDate DATE,
    Price DECIMAL(10, 2)
);

-- Create Booking table
CREATE TABLE Booking (
    BookingID INT PRIMARY KEY AUTO_INCREMENT,
    CustomerID INT,
    TripID INT,
    BookingDate DATE,
    FOREIGN KEY (CustomerID) REFERENCES Customer(CustomerID),
    FOREIGN KEY (TripID) REFERENCES Trip(TripID)
);

-- Create Payment table
CREATE TABLE Payment (
    PaymentID INT PRIMARY KEY AUTO_INCREMENT,
    BookingID INT,
    Amount DECIMAL(10, 2),
    PaymentDate DATE,
    FOREIGN KEY (BookingID) REFERENCES Booking(BookingID)
);

-- Create HospitalPackage table
CREATE TABLE HospitalPackage (
    PackageID INT PRIMARY KEY AUTO_INCREMENT,
    HospitalName VARCHAR(255),
    MedicalServices VARCHAR(255),
    Price DECIMAL(10, 2)
);

-- Create HotelPackage table
CREATE TABLE HotelPackage (
    PackageID INT PRIMARY KEY AUTO_INCREMENT,
    HotelName VARCHAR(255),
    RoomType VARCHAR(50),
    Price DECIMAL(10, 2)
);

-- Create TransportPackage table
CREATE TABLE TransportPackage (
    PackageID INT PRIMARY KEY AUTO_INCREMENT,
    TransportCompany VARCHAR(255),
    TransportType VARCHAR(50),
    Price DECIMAL(10, 2)
);

-- Add PackageID column to Booking table
ALTER TABLE Booking
ADD PackageID INT,
ADD FOREIGN KEY (PackageID) REFERENCES HospitalPackage(PackageID),
ADD FOREIGN KEY (PackageID) REFERENCES HotelPackage(PackageID),
ADD FOREIGN KEY (PackageID) REFERENCES TransportPackage(PackageID);
