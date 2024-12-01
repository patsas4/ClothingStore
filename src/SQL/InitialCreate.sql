-- Create Fit ########################################################################################################################################################################
CREATE TABLE [dbo].[Fit](
	[FitId] [int] IDENTITY(1,1) NOT NULL,
	[FitType] [nvarchar](50) NOT NULL,
 CONSTRAINT [PK_Fit_FitId] PRIMARY KEY CLUSTERED 
(
	[FitId] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO

-- Create Category ########################################################################################################################################################################
CREATE TABLE [dbo].[Category](
	[CategoryId] [int] IDENTITY(1,1) NOT NULL,
	[CategoryName] [nvarchar](50) NOT NULL,
 CONSTRAINT [PK_Category_CategoryId] PRIMARY KEY CLUSTERED 
(
	[CategoryId] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO

-- Create Item ########################################################################################################################################################################
CREATE TABLE [dbo].[Item](
	[ItemId] [int] IDENTITY(1,1) NOT NULL,
	[ItemName] [nvarchar](50) NOT NULL,
	[Price] [money] NOT NULL,
	[CategoryId] [int] NOT NULL,
	[FitId] [int] NULL,
	[ImagePath] [nvarchar](50) NULL
 CONSTRAINT [PK_Item_ItemId] PRIMARY KEY CLUSTERED 
(
	[ItemId] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO

ALTER TABLE [dbo].[Item]  WITH CHECK ADD  CONSTRAINT [FK_Item_Category_Id] FOREIGN KEY([CategoryId])
REFERENCES [dbo].[Category] ([CategoryId])
GO

ALTER TABLE [dbo].[Item] CHECK CONSTRAINT [FK_Item_Category_Id]
GO

ALTER TABLE [dbo].[Item]  WITH CHECK ADD  CONSTRAINT [FK_Item_Fit_Id] FOREIGN KEY([FitId])
REFERENCES [dbo].[Fit] ([FitId])
GO

ALTER TABLE [dbo].[Item] CHECK CONSTRAINT [FK_Item_Fit_Id]
GO

-- Customer ###################################################################################################################################################################################
CREATE TABLE [dbo].[Customer](
	[CustomerId] [int] IDENTITY(1,1) NOT NULL,
	[FirstName] [nvarchar](100) NOT NULL,
	[LastName] [nvarchar](100) NOT NULL,
	[Email] [nvarchar](max) NOT NULL,
	[Password] [nvarchar](max) NOT NULL
 CONSTRAINT [PK_Customer_CustomerId] PRIMARY KEY CLUSTERED 
(
	[CustomerId] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO

-- Orders ######################################################################################################################################################################################
CREATE TABLE [dbo].[Order](
	[OrderId] [int] IDENTITY(1,1) NOT NULL,
	[CustomerId] [int] NOT NULL,
	[DateOrdered] [datetime2] NOT NULL,
	[Total] [money] NULL
 CONSTRAINT [PK_Order_OrderId] PRIMARY KEY CLUSTERED 
(
	[OrderId] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO

ALTER TABLE [dbo].[Order]  WITH CHECK ADD  CONSTRAINT [FK_OrderedItem_Customer_Id] FOREIGN KEY(CustomerId)
REFERENCES [dbo].[Customer] ([CustomerId])

--Ordered Item #####################################################################################################################################################################################
CREATE TABLE [dbo].[OrderedItem](
	[OrderedItemId] [int] IDENTITY(1,1) NOT NULL,
	[OrderId] [int] NOT NULL,
	[ItemId] [int] NOT NULL,
	[Quantity] [int] NOT NULL,
	[Price] [money] NOT NULL
 CONSTRAINT [PK_OrderedItem_OrderedItemId] PRIMARY KEY CLUSTERED
 (
	[OrderedItemId] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO

ALTER TABLE [dbo].[OrderedItem]  WITH CHECK ADD  CONSTRAINT [FK_OrderedItem_Item_Id] FOREIGN KEY([ItemId])
REFERENCES [dbo].[Item] ([ItemId])

ALTER TABLE [dbo].[OrderedItem]  WITH CHECK ADD  CONSTRAINT [FK_OrderedItem_Order_Id] FOREIGN KEY([OrderId])
REFERENCES [dbo].[Order] ([OrderId])

-- Cart ##############################################################################################################################################################################################
CREATE TABLE [dbo].[Cart](
	[CartId] [int] IDENTITY(1,1) NOT NULL,
	[CustomerId] [int] NOT NULL
 CONSTRAINT [PK_Cart_CartId] PRIMARY KEY CLUSTERED
 (
	[CartId] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO

ALTER TABLE [dbo].[Cart]  WITH CHECK ADD  CONSTRAINT [FK_Cart_Customer_Id] FOREIGN KEY([CustomerId])
REFERENCES [dbo].[Customer] ([CustomerId])

-- CartItem #############################################################################################################################################################################################
CREATE TABLE [dbo].[CartItem](
	[CartItemId] [int] IDENTITY(1,1) NOT NULL,
	[CartId] [int] NOT NULL,
	[ItemId] [int] NOT NULL,
	[Quantity] [int] NOT NULL,
	[Price] [money] NOT NULL
 CONSTRAINT [PK_CartItem_CartItemId] PRIMARY KEY CLUSTERED
 (
	[CartItemId] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO

ALTER TABLE [dbo].[CartItem]  WITH CHECK ADD  CONSTRAINT [FK_CartItem_Item_Id] FOREIGN KEY([ItemId])
REFERENCES [dbo].[Item] ([ItemId])

ALTER TABLE [dbo].[CartItem]  WITH CHECK ADD  CONSTRAINT [FK_CartItem_Cart_Id] FOREIGN KEY([CartId])
REFERENCES [dbo].[Cart] ([CartId])