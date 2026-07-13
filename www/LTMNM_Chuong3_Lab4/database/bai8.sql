USE labdb;

ALTER TABLE students
ADD COLUMN birthday DATE NULL AFTER phone;

UPDATE students
SET birthday = CASE id
    WHEN 1 THEN '2003-01-15'
    WHEN 2 THEN '2003-06-20'
    ELSE birthday
END
WHERE id IN (1, 2);
