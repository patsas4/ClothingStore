-- Insert Into Categories ################################################
PRINT ''
PRINT 'Initial Insert into category'

IF NOT EXISTS (SELECT * FROM Category WHERE CategoryName = 'Shorts') --1
	INSERT INTO [dbo].[Category] ([CategoryName])
	VALUES ('Shorts')

IF NOT EXISTS (SELECT * FROM Category WHERE CategoryName = 'Shirt') --2
	INSERT INTO [dbo].[Category] ([CategoryName])
	VALUES ('Shirt')

IF NOT EXISTS (SELECT * FROM Category WHERE CategoryName = 'Pants') --3
	INSERT INTO [dbo].[Category] ([CategoryName])
	VALUES ('Pants')

IF NOT EXISTS (SELECT * FROM Category WHERE CategoryName = 'Sweatshirt') --4
	INSERT INTO [dbo].[Category] ([CategoryName])
	VALUES ('Sweatshirt')

IF NOT EXISTS (SELECT * FROM Category WHERE CategoryName = 'Socks') --5
	INSERT INTO [dbo].[Category] ([CategoryName])
	VALUES ('Socks')

IF NOT EXISTS (SELECT * FROM Category WHERE CategoryName = 'Sweatpants') --6
	INSERT INTO [dbo].[Category] ([CategoryName])
	VALUES ('Sweatpants')

IF NOT EXISTS (SELECT * FROM Category WHERE CategoryName = 'Hat') --7
	INSERT INTO [dbo].[Category] ([CategoryName])
	VALUES ('Hat')

IF NOT EXISTS (SELECT * FROM Category WHERE CategoryName = 'Jacket') --8
	INSERT INTO [dbo].[Category] ([CategoryName])
	VALUES ('Jacket')

-- Insert into Fit ###############################################################
PRINT ''
PRINT 'Initial Insert Into Fit'

IF NOT EXISTS (SELECT * FROM Fit WHERE FitType = 'Slim') --1
	INSERT INTO [dbo].[Fit] ([FitType])
	VALUES ('Slim')

IF NOT EXISTS (SELECT * FROM Fit WHERE FitType = 'Loose') --2
	INSERT INTO [dbo].[Fit] ([FitType])
	VALUES ('Loose')

IF NOT EXISTS (SELECT * FROM Fit WHERE FitType = 'OverSized') --3
	INSERT INTO [dbo].[Fit] ([FitType])
	VALUES ('OverSized')

IF NOT EXISTS (SELECT * FROM Fit WHERE FitType = 'Normal') --4
	INSERT INTO [dbo].[Fit] ([FitType])
	VALUES ('Normal')

-- Insert Items #####################################################################
PRINT ''
PRINT 'Insert Into Item'

IF NOT EXISTS (SELECT * FROM Item WHERE ItemName = 'Running Shorts')
	INSERT INTO [dbo].[Item] ([ItemName], [CategoryId], [FitId], [Price])
	VALUES ('Running Shorts', 1, 4, 8.99)

IF NOT EXISTS (SELECT * FROM Item WHERE ItemName = 'Slim Running Shorts')
	INSERT INTO [dbo].[Item] ([ItemName], [CategoryId], [FitId], [Price])
	VALUES ('Slim Running Shorts', 1, 1, 7.99)

IF NOT EXISTS (SELECT * FROM Item WHERE ItemName = 'Plain Tshirt')
	INSERT INTO [dbo].[Item] ([ItemName], [CategoryId], [FitId], [Price])
	VALUES ('Plain Tshirt', 2, 4, 15.99)

IF NOT EXISTS (SELECT * FROM Item WHERE ItemName = 'Graphic Tshirt')
	INSERT INTO [dbo].[Item] ([ItemName], [CategoryId], [FitId], [Price])
	VALUES ('Graphic Tshirt', 2, 3, 20.00)

IF NOT EXISTS (SELECT * FROM Item WHERE ItemName = 'Cargo Pants')
	INSERT INTO [dbo].[Item] ([ItemName], [CategoryId], [FitId], [Price])
	VALUES ('Cargo Pants', 3, 3, 22.00)

IF NOT EXISTS (SELECT * FROM Item WHERE ItemName = 'Jeans')
	INSERT INTO [dbo].[Item] ([ItemName], [CategoryId], [FitId], [Price])
	VALUES ('Jeans', 3, 4, 56.00)

IF NOT EXISTS (SELECT * FROM Item WHERE ItemName = 'Tye Dye Sweatshirt')
	INSERT INTO [dbo].[Item] ([ItemName], [CategoryId], [FitId], [Price])
	VALUES ('Tye Dye Sweatshirt', 4, 3, 45.50)

IF NOT EXISTS (SELECT * FROM Item WHERE ItemName = 'Sweater')
	INSERT INTO [dbo].[Item] ([ItemName], [CategoryId], [FitId], [Price])
	VALUES ('Sweater', 4, 4, 36.00)

IF NOT EXISTS (SELECT * FROM Item WHERE ItemName = 'High Socks')
	INSERT INTO [dbo].[Item] ([ItemName], [CategoryId], [FitId], [Price])
	VALUES ('High Socks', 5, 4, 12.00)

IF NOT EXISTS (SELECT * FROM Item WHERE ItemName = 'Low Socks')
	INSERT INTO [dbo].[Item] ([ItemName], [CategoryId], [FitId], [Price])
	VALUES ('Low Socks', 5, 4, 10.00)

IF NOT EXISTS (SELECT * FROM Item WHERE ItemName = 'Joggers')
	INSERT INTO [dbo].[Item] ([ItemName], [CategoryId], [FitId], [Price])
	VALUES ('Joggers', 6, 4, 28.00)

IF NOT EXISTS (SELECT * FROM Item WHERE ItemName = 'Sweatpants')
	INSERT INTO [dbo].[Item] ([ItemName], [CategoryId], [FitId], [Price])
	VALUES ('Sweatpants', 6, 3, 28.00)

IF NOT EXISTS (SELECT * FROM Item WHERE ItemName = 'Baseball Hat')
	INSERT INTO [dbo].[Item] ([ItemName], [CategoryId], [FitId], [Price])
	VALUES ('Baseball Hat', 7, 4, 15.00)

IF NOT EXISTS (SELECT * FROM Item WHERE ItemName = 'Beanie')
	INSERT INTO [dbo].[Item] ([ItemName], [CategoryId], [FitId], [Price])
	VALUES ('Beanie', 7, 4, 12.00)

IF NOT EXISTS (SELECT * FROM Item WHERE ItemName = 'Light Jacket')
	INSERT INTO [dbo].[Item] ([ItemName], [CategoryId], [FitId], [Price])
	VALUES ('Light Jacket', 8, 4, 12.00)

IF NOT EXISTS (SELECT * FROM Item WHERE ItemName = 'Rain Jacket')
	INSERT INTO [dbo].[Item] ([ItemName], [CategoryId], [FitId], [Price])
	VALUES ('Rain Jacket', 8, 2, 12.00)

	