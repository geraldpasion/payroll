BEGIN
	DECLARE crt_date DATE;
	DECLARE emp_id VARCHAR(10);
	DECLARE emp_shift VARCHAR(50);
	DECLARE emp_rest VARCHAR(50);	
	DECLARE ctr INT(50);	
	DECLARE ctr1 INT(50);	
	SET crt_date=start_date;
	SET @ctr=1;
	SET @ctr1=1;

	WHILE (SELECT COUNT(*) FROM employee) != (@ctr-1) DO
		WHILE crt_date <= end_date DO
			WHILE (SELECT MAX(employee_id) AS employee_id FROM employee) != (@ctr1-1) DO
				IF(SELECT COUNT(*) FROM employee WHERE employee_id=@ctr1) > 0 THEN
					SELECT employee_id, employee_shift, employee_restday INTO @emp_id, @emp_shift, @emp_rest FROM employee WHERE employee_id=@ctr1;
					IF NOT EXISTS ( SELECT * FROM attendance WHERE employee_id = @emp_id AND attendance_date = @crt_date )
					
					INSERT INTO attendance(employee_id, attendance_shift, attendance_restday, attendance_date) VALUES(@emp_id, @emp_shift, @emp_rest, crt_date)
					WHERE   NOT EXISTS 
			        (   SELECT  1
			            FROM  attendance 
			            WHERE  employee_id : @emp_id
			            AND    attendance_date  = @crt_date
			        );
			        
					
					END IF
				ELSE;
					SELECT 0;
				END IF;
				SET @ctr1 = @ctr1 + 1;
			END WHILE;
			SET @ctr1 = 1;
			SET @ctr = @ctr + 1;
			SET crt_date = ADDDATE(crt_date, INTERVAL 1 DAY);
		END WHILE;
	END WHILE;
END