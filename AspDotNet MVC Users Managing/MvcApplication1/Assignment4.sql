USE [master]
GO
/****** Object:  Database [Assignment4]    Script Date: 5/3/2018 10:38:36 AM ******/
CREATE DATABASE [Assignment4]
 CONTAINMENT = NONE
 ON  PRIMARY 
( NAME = N'Assignment4', FILENAME = N'C:\Program Files\Microsoft SQL Server\MSSQL11.SQLEXPRESS2012\MSSQL\DATA\Assignment4.mdf' , SIZE = 3072KB , MAXSIZE = UNLIMITED, FILEGROWTH = 1024KB )
 LOG ON 
( NAME = N'Assignment4_log', FILENAME = N'C:\Program Files\Microsoft SQL Server\MSSQL11.SQLEXPRESS2012\MSSQL\DATA\Assignment4_log.ldf' , SIZE = 1024KB , MAXSIZE = 2048GB , FILEGROWTH = 10%)
GO
ALTER DATABASE [Assignment4] SET COMPATIBILITY_LEVEL = 110
GO
IF (1 = FULLTEXTSERVICEPROPERTY('IsFullTextInstalled'))
begin
EXEC [Assignment4].[dbo].[sp_fulltext_database] @action = 'enable'
end
GO
ALTER DATABASE [Assignment4] SET ANSI_NULL_DEFAULT OFF 
GO
ALTER DATABASE [Assignment4] SET ANSI_NULLS OFF 
GO
ALTER DATABASE [Assignment4] SET ANSI_PADDING OFF 
GO
ALTER DATABASE [Assignment4] SET ANSI_WARNINGS OFF 
GO
ALTER DATABASE [Assignment4] SET ARITHABORT OFF 
GO
ALTER DATABASE [Assignment4] SET AUTO_CLOSE OFF 
GO
ALTER DATABASE [Assignment4] SET AUTO_CREATE_STATISTICS ON 
GO
ALTER DATABASE [Assignment4] SET AUTO_SHRINK OFF 
GO
ALTER DATABASE [Assignment4] SET AUTO_UPDATE_STATISTICS ON 
GO
ALTER DATABASE [Assignment4] SET CURSOR_CLOSE_ON_COMMIT OFF 
GO
ALTER DATABASE [Assignment4] SET CURSOR_DEFAULT  GLOBAL 
GO
ALTER DATABASE [Assignment4] SET CONCAT_NULL_YIELDS_NULL OFF 
GO
ALTER DATABASE [Assignment4] SET NUMERIC_ROUNDABORT OFF 
GO
ALTER DATABASE [Assignment4] SET QUOTED_IDENTIFIER OFF 
GO
ALTER DATABASE [Assignment4] SET RECURSIVE_TRIGGERS OFF 
GO
ALTER DATABASE [Assignment4] SET  DISABLE_BROKER 
GO
ALTER DATABASE [Assignment4] SET AUTO_UPDATE_STATISTICS_ASYNC OFF 
GO
ALTER DATABASE [Assignment4] SET DATE_CORRELATION_OPTIMIZATION OFF 
GO
ALTER DATABASE [Assignment4] SET TRUSTWORTHY OFF 
GO
ALTER DATABASE [Assignment4] SET ALLOW_SNAPSHOT_ISOLATION OFF 
GO
ALTER DATABASE [Assignment4] SET PARAMETERIZATION SIMPLE 
GO
ALTER DATABASE [Assignment4] SET READ_COMMITTED_SNAPSHOT OFF 
GO
ALTER DATABASE [Assignment4] SET HONOR_BROKER_PRIORITY OFF 
GO
ALTER DATABASE [Assignment4] SET RECOVERY SIMPLE 
GO
ALTER DATABASE [Assignment4] SET  MULTI_USER 
GO
ALTER DATABASE [Assignment4] SET PAGE_VERIFY CHECKSUM  
GO
ALTER DATABASE [Assignment4] SET DB_CHAINING OFF 
GO
ALTER DATABASE [Assignment4] SET FILESTREAM( NON_TRANSACTED_ACCESS = OFF ) 
GO
ALTER DATABASE [Assignment4] SET TARGET_RECOVERY_TIME = 0 SECONDS 
GO
USE [Assignment4]
GO
/****** Object:  Table [dbo].[Admin]    Script Date: 5/3/2018 10:38:36 AM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[Admin](
	[AdminID] [int] IDENTITY(1,1) NOT NULL,
	[AdminName] [varchar](50) NULL,
	[Login] [varchar](50) NULL,
	[Password] [varchar](50) NULL,
 CONSTRAINT [PK_Admin] PRIMARY KEY CLUSTERED 
(
	[AdminID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO
SET ANSI_PADDING OFF
GO
/****** Object:  Table [dbo].[Users]    Script Date: 5/3/2018 10:38:36 AM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[Users](
	[UserID] [int] IDENTITY(1,1) NOT NULL,
	[Name] [varchar](50) NOT NULL,
	[Login] [varchar](50) NOT NULL,
	[Password] [varchar](50) NOT NULL,
	[Email] [varchar](50) NOT NULL,
	[Gender] [char](1) NOT NULL,
	[Address] [varchar](50) NOT NULL,
	[Age] [int] NOT NULL,
	[NIC] [varchar](20) NOT NULL,
	[DOB] [date] NOT NULL,
	[IsCricket] [bit] NOT NULL,
	[Hockey] [bit] NOT NULL,
	[Chess] [bit] NOT NULL,
	[ImageName] [varchar](50) NOT NULL,
	[CreatedOn] [datetime] NOT NULL,
 CONSTRAINT [PK_Users] PRIMARY KEY CLUSTERED 
(
	[UserID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO
SET ANSI_PADDING OFF
GO
SET IDENTITY_INSERT [dbo].[Admin] ON 

INSERT [dbo].[Admin] ([AdminID], [AdminName], [Login], [Password]) VALUES (1, N'Bilal', N'admin', N'admin')
SET IDENTITY_INSERT [dbo].[Admin] OFF
SET IDENTITY_INSERT [dbo].[Users] ON 

INSERT [dbo].[Users] ([UserID], [Name], [Login], [Password], [Email], [Gender], [Address], [Age], [NIC], [DOB], [IsCricket], [Hockey], [Chess], [ImageName], [CreatedOn]) VALUES (5, N'Hammad', N'hammad120', N'12345', N'bcsf15m009@pucit.edu.pk', N'M', N'32,Munir Shaheed,Colony', 25, N'32719286126', CAST(0x3D3E0B00 AS Date), 1, 0, 0, N'', CAST(0x0000A8D500A6E438 AS DateTime))
INSERT [dbo].[Users] ([UserID], [Name], [Login], [Password], [Email], [Gender], [Address], [Age], [NIC], [DOB], [IsCricket], [Hockey], [Chess], [ImageName], [CreatedOn]) VALUES (12, N'usman', N'usman120', N'12345', N'usman120@gmail.com', N'M', N'32,munr shaheed colony', 21, N'32719286126', CAST(0x4B3E0B00 AS Date), 1, 0, 0, N'', CAST(0x0000A8D30012E0D0 AS DateTime))
INSERT [dbo].[Users] ([UserID], [Name], [Login], [Password], [Email], [Gender], [Address], [Age], [NIC], [DOB], [IsCricket], [Hockey], [Chess], [ImageName], [CreatedOn]) VALUES (1004, N'ali', N'ali', N'1234', N'ali@gmail.com', N'M', N'asdas', 20, N'1844871662', CAST(0x383E0B00 AS Date), 0, 0, 0, N'', CAST(0x0000A8D500ABDF38 AS DateTime))
SET IDENTITY_INSERT [dbo].[Users] OFF
USE [master]
GO
ALTER DATABASE [Assignment4] SET  READ_WRITE 
GO
