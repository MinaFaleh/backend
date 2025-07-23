CREATE TABLE Users (
	UserID INT NOT NULL identity(1,1),
	LoginName VARCHAR(100) NOT NULL,
	UserName VARCHAR(100) NOT NULL,
	Pass INT NOT NULL,
	ExpiryDate date NOT NULL default getdate() + 90,
	Email VARCHAR(100) NOT NULL,
    CONSTRAINT PK_Users PRIMARY KEY (UserID)
);

INSERT INTO Users (LoginName, UserName, Pass, ExpiryDate, Email)
VALUES ('Mariam1', 'mariam', 159, '2026-12-30', 'mariam.sut115@gmail.com'),
		('Mina2', 'mina', 123, '2026-12-30', 'minafalehaziz@gmail.com'), 
		('Mohamed3', 'mohamed', 369, '2025-10-30', 'mmm@gmail.com'),
		('Salma4', 'salma', 854, '2025-7-30', 'salma@gmail.com'),
		('Merna5', 'merna', 943, '2025-7-3', 'merna@gmail.com');

CREATE UNIQUE INDEX IX_users_username   
   ON users (username);   

CREATE UNIQUE INDEX IX_users_email   
   ON users (email);   


create TRIGGER SetLoginName ON Users

INSTEAD OF INSERT
AS
BEGIN
    SET NOCOUNT ON;

    INSERT INTO Users (LoginName, UserName, Pass, Email)
    SELECT 
        LEFT(i.Email, CHARINDEX('@', i.Email) - 1),
        i.UserName,
        i.Pass,
        i.Email

    FROM inserted i;

END;





SELECT * FROM Users;


--alter table users add constraint 



CREATE PROCEDURE SIGNUP_PRO
    @UserName VARCHAR(100),
    @Pass VARCHAR(100),
    @Email VARCHAR(100)
AS
BEGIN
    SET NOCOUNT ON;

    BEGIN TRY

        INSERT INTO Users (UserName, Email, Pass)
        VALUES (@UserName, @Email, @Pass);

        SELECT 'User registered successfully.' AS Result;
    END TRY

    BEGIN CATCH

        SELECT 
            ERROR_number() as msgid, ERROR_MESSAGE() as msg;

    END CATCH
END;

EXEC SIGNUP_PRO @UserName = 'mariam', @Pass = '123', @Email = 'mk@gmail.com' ;

EXEC SIGNUP_PRO @UserName = 'mariaaaam', @Pass = '123', @Email = 'mariam.sut115@gmail.com' ;

EXEC SIGNUP_PRO @UserName = 'mariaaaam', @Pass = '123', @Email = 'mk@gmail.com' ;

EXEC SIGNUP_PRO @UserName = 'mariaaaam123', @Pass = '123', @Email = 'mariam@gmail.com' ;



SELECT * FROM USERS







alter PROCEDURE LOGIN_PRO 
    (@arg_LoginName VARCHAR(100),
    @arg_Password INT)
AS
    DECLARE @UserID INT;
    DECLARE @username VARCHAR(100);
    DECLARE @ExpiryDate DATE;
    DECLARE @MsgID INT;
    DECLARE @Msg VARCHAR(100);
    DECLARE @pass VARCHAR(100);


	SELECT @UserID = userid, @username = username, @Pass = pass, @ExpiryDate = expirydate

    From Users

    WHERE loginname = @arg_LoginName;


    IF @UserID IS NULl
    BEGIN
        select -1 as msgid, 'invalid loginname' as msg, null as userid, null as username;
        RETURN;
    END
    
    IF @arg_Password <> @Pass
    BEGIN
        SELECT -2 AS msgid, 'invalid pass' AS msg, null as userid, null as username; 
        RETURN
    END
    
    IF @ExpiryDate < CAST(GETDATE() AS DATE)
    BEGIN
        SELECT -3 AS msgid, 'expiry date' AS msgid, null as userid, null as username;
        RETURN;
    END
    
    select 0 as msgid, 'success' as msg, @UserID as userid, @username as username;


EXEC LOGIN_PRO @arg_LoginName = 'X', @arg_Password='12';




    
alter table users alter column userid identity(1,1) int not null


Alter Table users
modify userid Int not null Identity(1, 1);

ALTER TABLE Users
ADD CONSTRAINT PK_Users PRIMARY KEY (UserID);