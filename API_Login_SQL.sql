CREATE TABLE Users (
	UserID INT NOT NULL,
	LoginName VARCHAR(100) NOT NULL,
	UserName VARCHAR(100) NOT NULL,
	Pass INT NOT NULL,
	ExpiryDate date NOT NULL,
	Email VARCHAR(100) NOT NULL
);

INSERT INTO Users (UserID, LoginName, UserName, Pass, ExpiryDate, Email)
VALUES (1, 'Mariam1', 'mariam', 159, '2026-12-30', 'mariam.sut115@gmail.com'),
		(2, 'Mina2', 'mina', 123, '2026-12-30', 'minafalehaziz@gmail.com'), 
		(3, 'Mohamed3', 'mohamed', 369, '2025-10-30', 'mmm@gmail.com'),
		(4, 'Salma4', 'salma', 854, '2025-7-30', 'salma@gmail.com'),
		(5, 'Merna5', 'merna', 943, '2025-7-3', 'merna@gmail.com');

SELECT * FROM Users;




CREATE PROCEDURE LOGIN_PRO 
    (@arg_LoginName VARCHAR(100),
    @arg_Password INT)
AS
    DECLARE @UserID INT;
    DECLARE @username VARCHAR(100);
    DECLARE @ExpiryDate DATE;
    DECLARE @MsgID INT;
    DECLARE @Msg VARCHAR(100);

	SELECT @UserID = userid, @arg_LoginName = loginname, 
    @username = username, @arg_Password = pass, @ExpiryDate = expirydate

    From Users

    WHERE loginname = @arg_LoginName;


    IF @UserID IS NULl
    BEGIN
        select -1 as msgid, 'invalid loginname' as msg, null as userid, null as username;
        RETURN;
    END
    
    IF @arg_Password <> @arg_Password
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




    
