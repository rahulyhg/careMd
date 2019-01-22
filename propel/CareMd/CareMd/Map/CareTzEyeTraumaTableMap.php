<?php

namespace CareMd\CareMd\Map;

use CareMd\CareMd\CareTzEyeTrauma;
use CareMd\CareMd\CareTzEyeTraumaQuery;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\InstancePoolTrait;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\DataFetcher\DataFetcherInterface;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\RelationMap;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Map\TableMapTrait;


/**
 * This class defines the structure of the 'care_tz_eye_trauma' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class CareTzEyeTraumaTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'CareMd.CareMd.Map.CareTzEyeTraumaTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'care_tz_eye_trauma';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\CareMd\\CareMd\\CareTzEyeTrauma';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'CareMd.CareMd.CareTzEyeTrauma';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 28;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 28;

    /**
     * the column name for the id field
     */
    const COL_ID = 'care_tz_eye_trauma.id';

    /**
     * the column name for the pid field
     */
    const COL_PID = 'care_tz_eye_trauma.pid';

    /**
     * the column name for the right_eye_test1 field
     */
    const COL_RIGHT_EYE_TEST1 = 'care_tz_eye_trauma.right_eye_test1';

    /**
     * the column name for the right_eye_test2 field
     */
    const COL_RIGHT_EYE_TEST2 = 'care_tz_eye_trauma.right_eye_test2';

    /**
     * the column name for the right_eye_test3 field
     */
    const COL_RIGHT_EYE_TEST3 = 'care_tz_eye_trauma.right_eye_test3';

    /**
     * the column name for the right_eye_test4 field
     */
    const COL_RIGHT_EYE_TEST4 = 'care_tz_eye_trauma.right_eye_test4';

    /**
     * the column name for the right_eye_test5 field
     */
    const COL_RIGHT_EYE_TEST5 = 'care_tz_eye_trauma.right_eye_test5';

    /**
     * the column name for the right_eye_test6 field
     */
    const COL_RIGHT_EYE_TEST6 = 'care_tz_eye_trauma.right_eye_test6';

    /**
     * the column name for the right_eye_test7 field
     */
    const COL_RIGHT_EYE_TEST7 = 'care_tz_eye_trauma.right_eye_test7';

    /**
     * the column name for the right_eye_test8 field
     */
    const COL_RIGHT_EYE_TEST8 = 'care_tz_eye_trauma.right_eye_test8';

    /**
     * the column name for the right_eye_test9 field
     */
    const COL_RIGHT_EYE_TEST9 = 'care_tz_eye_trauma.right_eye_test9';

    /**
     * the column name for the right_eye_test10 field
     */
    const COL_RIGHT_EYE_TEST10 = 'care_tz_eye_trauma.right_eye_test10';

    /**
     * the column name for the right_eye_test11 field
     */
    const COL_RIGHT_EYE_TEST11 = 'care_tz_eye_trauma.right_eye_test11';

    /**
     * the column name for the right_eye_test12 field
     */
    const COL_RIGHT_EYE_TEST12 = 'care_tz_eye_trauma.right_eye_test12';

    /**
     * the column name for the left_eye_test1 field
     */
    const COL_LEFT_EYE_TEST1 = 'care_tz_eye_trauma.left_eye_test1';

    /**
     * the column name for the left_eye_test2 field
     */
    const COL_LEFT_EYE_TEST2 = 'care_tz_eye_trauma.left_eye_test2';

    /**
     * the column name for the left_eye_test3 field
     */
    const COL_LEFT_EYE_TEST3 = 'care_tz_eye_trauma.left_eye_test3';

    /**
     * the column name for the left_eye_test4 field
     */
    const COL_LEFT_EYE_TEST4 = 'care_tz_eye_trauma.left_eye_test4';

    /**
     * the column name for the left_eye_test5 field
     */
    const COL_LEFT_EYE_TEST5 = 'care_tz_eye_trauma.left_eye_test5';

    /**
     * the column name for the left_eye_test6 field
     */
    const COL_LEFT_EYE_TEST6 = 'care_tz_eye_trauma.left_eye_test6';

    /**
     * the column name for the left_eye_test7 field
     */
    const COL_LEFT_EYE_TEST7 = 'care_tz_eye_trauma.left_eye_test7';

    /**
     * the column name for the left_eye_test8 field
     */
    const COL_LEFT_EYE_TEST8 = 'care_tz_eye_trauma.left_eye_test8';

    /**
     * the column name for the left_eye_test9 field
     */
    const COL_LEFT_EYE_TEST9 = 'care_tz_eye_trauma.left_eye_test9';

    /**
     * the column name for the left_eye_test10 field
     */
    const COL_LEFT_EYE_TEST10 = 'care_tz_eye_trauma.left_eye_test10';

    /**
     * the column name for the left_eye_test11 field
     */
    const COL_LEFT_EYE_TEST11 = 'care_tz_eye_trauma.left_eye_test11';

    /**
     * the column name for the left_eye_test12 field
     */
    const COL_LEFT_EYE_TEST12 = 'care_tz_eye_trauma.left_eye_test12';

    /**
     * the column name for the Signature field
     */
    const COL_SIGNATURE = 'care_tz_eye_trauma.Signature';

    /**
     * the column name for the Examination_date field
     */
    const COL_EXAMINATION_DATE = 'care_tz_eye_trauma.Examination_date';

    /**
     * The default string format for model objects of the related table
     */
    const DEFAULT_STRING_FORMAT = 'YAML';

    /**
     * holds an array of fieldnames
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldNames[self::TYPE_PHPNAME][0] = 'Id'
     */
    protected static $fieldNames = array (
        self::TYPE_PHPNAME       => array('Id', 'Pid', 'RightEyeTest1', 'RightEyeTest2', 'RightEyeTest3', 'RightEyeTest4', 'RightEyeTest5', 'RightEyeTest6', 'RightEyeTest7', 'RightEyeTest8', 'RightEyeTest9', 'RightEyeTest10', 'RightEyeTest11', 'RightEyeTest12', 'LeftEyeTest1', 'LeftEyeTest2', 'LeftEyeTest3', 'LeftEyeTest4', 'LeftEyeTest5', 'LeftEyeTest6', 'LeftEyeTest7', 'LeftEyeTest8', 'LeftEyeTest9', 'LeftEyeTest10', 'LeftEyeTest11', 'LeftEyeTest12', 'Signature', 'ExaminationDate', ),
        self::TYPE_CAMELNAME     => array('id', 'pid', 'rightEyeTest1', 'rightEyeTest2', 'rightEyeTest3', 'rightEyeTest4', 'rightEyeTest5', 'rightEyeTest6', 'rightEyeTest7', 'rightEyeTest8', 'rightEyeTest9', 'rightEyeTest10', 'rightEyeTest11', 'rightEyeTest12', 'leftEyeTest1', 'leftEyeTest2', 'leftEyeTest3', 'leftEyeTest4', 'leftEyeTest5', 'leftEyeTest6', 'leftEyeTest7', 'leftEyeTest8', 'leftEyeTest9', 'leftEyeTest10', 'leftEyeTest11', 'leftEyeTest12', 'signature', 'examinationDate', ),
        self::TYPE_COLNAME       => array(CareTzEyeTraumaTableMap::COL_ID, CareTzEyeTraumaTableMap::COL_PID, CareTzEyeTraumaTableMap::COL_RIGHT_EYE_TEST1, CareTzEyeTraumaTableMap::COL_RIGHT_EYE_TEST2, CareTzEyeTraumaTableMap::COL_RIGHT_EYE_TEST3, CareTzEyeTraumaTableMap::COL_RIGHT_EYE_TEST4, CareTzEyeTraumaTableMap::COL_RIGHT_EYE_TEST5, CareTzEyeTraumaTableMap::COL_RIGHT_EYE_TEST6, CareTzEyeTraumaTableMap::COL_RIGHT_EYE_TEST7, CareTzEyeTraumaTableMap::COL_RIGHT_EYE_TEST8, CareTzEyeTraumaTableMap::COL_RIGHT_EYE_TEST9, CareTzEyeTraumaTableMap::COL_RIGHT_EYE_TEST10, CareTzEyeTraumaTableMap::COL_RIGHT_EYE_TEST11, CareTzEyeTraumaTableMap::COL_RIGHT_EYE_TEST12, CareTzEyeTraumaTableMap::COL_LEFT_EYE_TEST1, CareTzEyeTraumaTableMap::COL_LEFT_EYE_TEST2, CareTzEyeTraumaTableMap::COL_LEFT_EYE_TEST3, CareTzEyeTraumaTableMap::COL_LEFT_EYE_TEST4, CareTzEyeTraumaTableMap::COL_LEFT_EYE_TEST5, CareTzEyeTraumaTableMap::COL_LEFT_EYE_TEST6, CareTzEyeTraumaTableMap::COL_LEFT_EYE_TEST7, CareTzEyeTraumaTableMap::COL_LEFT_EYE_TEST8, CareTzEyeTraumaTableMap::COL_LEFT_EYE_TEST9, CareTzEyeTraumaTableMap::COL_LEFT_EYE_TEST10, CareTzEyeTraumaTableMap::COL_LEFT_EYE_TEST11, CareTzEyeTraumaTableMap::COL_LEFT_EYE_TEST12, CareTzEyeTraumaTableMap::COL_SIGNATURE, CareTzEyeTraumaTableMap::COL_EXAMINATION_DATE, ),
        self::TYPE_FIELDNAME     => array('id', 'pid', 'right_eye_test1', 'right_eye_test2', 'right_eye_test3', 'right_eye_test4', 'right_eye_test5', 'right_eye_test6', 'right_eye_test7', 'right_eye_test8', 'right_eye_test9', 'right_eye_test10', 'right_eye_test11', 'right_eye_test12', 'left_eye_test1', 'left_eye_test2', 'left_eye_test3', 'left_eye_test4', 'left_eye_test5', 'left_eye_test6', 'left_eye_test7', 'left_eye_test8', 'left_eye_test9', 'left_eye_test10', 'left_eye_test11', 'left_eye_test12', 'Signature', 'Examination_date', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('Id' => 0, 'Pid' => 1, 'RightEyeTest1' => 2, 'RightEyeTest2' => 3, 'RightEyeTest3' => 4, 'RightEyeTest4' => 5, 'RightEyeTest5' => 6, 'RightEyeTest6' => 7, 'RightEyeTest7' => 8, 'RightEyeTest8' => 9, 'RightEyeTest9' => 10, 'RightEyeTest10' => 11, 'RightEyeTest11' => 12, 'RightEyeTest12' => 13, 'LeftEyeTest1' => 14, 'LeftEyeTest2' => 15, 'LeftEyeTest3' => 16, 'LeftEyeTest4' => 17, 'LeftEyeTest5' => 18, 'LeftEyeTest6' => 19, 'LeftEyeTest7' => 20, 'LeftEyeTest8' => 21, 'LeftEyeTest9' => 22, 'LeftEyeTest10' => 23, 'LeftEyeTest11' => 24, 'LeftEyeTest12' => 25, 'Signature' => 26, 'ExaminationDate' => 27, ),
        self::TYPE_CAMELNAME     => array('id' => 0, 'pid' => 1, 'rightEyeTest1' => 2, 'rightEyeTest2' => 3, 'rightEyeTest3' => 4, 'rightEyeTest4' => 5, 'rightEyeTest5' => 6, 'rightEyeTest6' => 7, 'rightEyeTest7' => 8, 'rightEyeTest8' => 9, 'rightEyeTest9' => 10, 'rightEyeTest10' => 11, 'rightEyeTest11' => 12, 'rightEyeTest12' => 13, 'leftEyeTest1' => 14, 'leftEyeTest2' => 15, 'leftEyeTest3' => 16, 'leftEyeTest4' => 17, 'leftEyeTest5' => 18, 'leftEyeTest6' => 19, 'leftEyeTest7' => 20, 'leftEyeTest8' => 21, 'leftEyeTest9' => 22, 'leftEyeTest10' => 23, 'leftEyeTest11' => 24, 'leftEyeTest12' => 25, 'signature' => 26, 'examinationDate' => 27, ),
        self::TYPE_COLNAME       => array(CareTzEyeTraumaTableMap::COL_ID => 0, CareTzEyeTraumaTableMap::COL_PID => 1, CareTzEyeTraumaTableMap::COL_RIGHT_EYE_TEST1 => 2, CareTzEyeTraumaTableMap::COL_RIGHT_EYE_TEST2 => 3, CareTzEyeTraumaTableMap::COL_RIGHT_EYE_TEST3 => 4, CareTzEyeTraumaTableMap::COL_RIGHT_EYE_TEST4 => 5, CareTzEyeTraumaTableMap::COL_RIGHT_EYE_TEST5 => 6, CareTzEyeTraumaTableMap::COL_RIGHT_EYE_TEST6 => 7, CareTzEyeTraumaTableMap::COL_RIGHT_EYE_TEST7 => 8, CareTzEyeTraumaTableMap::COL_RIGHT_EYE_TEST8 => 9, CareTzEyeTraumaTableMap::COL_RIGHT_EYE_TEST9 => 10, CareTzEyeTraumaTableMap::COL_RIGHT_EYE_TEST10 => 11, CareTzEyeTraumaTableMap::COL_RIGHT_EYE_TEST11 => 12, CareTzEyeTraumaTableMap::COL_RIGHT_EYE_TEST12 => 13, CareTzEyeTraumaTableMap::COL_LEFT_EYE_TEST1 => 14, CareTzEyeTraumaTableMap::COL_LEFT_EYE_TEST2 => 15, CareTzEyeTraumaTableMap::COL_LEFT_EYE_TEST3 => 16, CareTzEyeTraumaTableMap::COL_LEFT_EYE_TEST4 => 17, CareTzEyeTraumaTableMap::COL_LEFT_EYE_TEST5 => 18, CareTzEyeTraumaTableMap::COL_LEFT_EYE_TEST6 => 19, CareTzEyeTraumaTableMap::COL_LEFT_EYE_TEST7 => 20, CareTzEyeTraumaTableMap::COL_LEFT_EYE_TEST8 => 21, CareTzEyeTraumaTableMap::COL_LEFT_EYE_TEST9 => 22, CareTzEyeTraumaTableMap::COL_LEFT_EYE_TEST10 => 23, CareTzEyeTraumaTableMap::COL_LEFT_EYE_TEST11 => 24, CareTzEyeTraumaTableMap::COL_LEFT_EYE_TEST12 => 25, CareTzEyeTraumaTableMap::COL_SIGNATURE => 26, CareTzEyeTraumaTableMap::COL_EXAMINATION_DATE => 27, ),
        self::TYPE_FIELDNAME     => array('id' => 0, 'pid' => 1, 'right_eye_test1' => 2, 'right_eye_test2' => 3, 'right_eye_test3' => 4, 'right_eye_test4' => 5, 'right_eye_test5' => 6, 'right_eye_test6' => 7, 'right_eye_test7' => 8, 'right_eye_test8' => 9, 'right_eye_test9' => 10, 'right_eye_test10' => 11, 'right_eye_test11' => 12, 'right_eye_test12' => 13, 'left_eye_test1' => 14, 'left_eye_test2' => 15, 'left_eye_test3' => 16, 'left_eye_test4' => 17, 'left_eye_test5' => 18, 'left_eye_test6' => 19, 'left_eye_test7' => 20, 'left_eye_test8' => 21, 'left_eye_test9' => 22, 'left_eye_test10' => 23, 'left_eye_test11' => 24, 'left_eye_test12' => 25, 'Signature' => 26, 'Examination_date' => 27, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, )
    );

    /**
     * Initialize the table attributes and columns
     * Relations are not initialized by this method since they are lazy loaded
     *
     * @return void
     * @throws PropelException
     */
    public function initialize()
    {
        // attributes
        $this->setName('care_tz_eye_trauma');
        $this->setPhpName('CareTzEyeTrauma');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\CareMd\\CareMd\\CareTzEyeTrauma');
        $this->setPackage('CareMd.CareMd');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, null, null);
        $this->addColumn('pid', 'Pid', 'INTEGER', false, 30, null);
        $this->addColumn('right_eye_test1', 'RightEyeTest1', 'VARCHAR', false, 100, null);
        $this->addColumn('right_eye_test2', 'RightEyeTest2', 'VARCHAR', false, 100, null);
        $this->addColumn('right_eye_test3', 'RightEyeTest3', 'VARCHAR', false, 100, null);
        $this->addColumn('right_eye_test4', 'RightEyeTest4', 'VARCHAR', false, 100, null);
        $this->addColumn('right_eye_test5', 'RightEyeTest5', 'VARCHAR', false, 100, null);
        $this->addColumn('right_eye_test6', 'RightEyeTest6', 'VARCHAR', false, 100, null);
        $this->addColumn('right_eye_test7', 'RightEyeTest7', 'VARCHAR', false, 100, null);
        $this->addColumn('right_eye_test8', 'RightEyeTest8', 'VARCHAR', false, 100, null);
        $this->addColumn('right_eye_test9', 'RightEyeTest9', 'VARCHAR', false, 100, null);
        $this->addColumn('right_eye_test10', 'RightEyeTest10', 'VARCHAR', false, 100, null);
        $this->addColumn('right_eye_test11', 'RightEyeTest11', 'VARCHAR', false, 100, null);
        $this->addColumn('right_eye_test12', 'RightEyeTest12', 'VARCHAR', false, 100, null);
        $this->addColumn('left_eye_test1', 'LeftEyeTest1', 'VARCHAR', false, 100, null);
        $this->addColumn('left_eye_test2', 'LeftEyeTest2', 'VARCHAR', false, 100, null);
        $this->addColumn('left_eye_test3', 'LeftEyeTest3', 'VARCHAR', false, 100, null);
        $this->addColumn('left_eye_test4', 'LeftEyeTest4', 'VARCHAR', false, 100, null);
        $this->addColumn('left_eye_test5', 'LeftEyeTest5', 'VARCHAR', false, 100, null);
        $this->addColumn('left_eye_test6', 'LeftEyeTest6', 'VARCHAR', false, 100, null);
        $this->addColumn('left_eye_test7', 'LeftEyeTest7', 'VARCHAR', false, 100, null);
        $this->addColumn('left_eye_test8', 'LeftEyeTest8', 'VARCHAR', false, 100, null);
        $this->addColumn('left_eye_test9', 'LeftEyeTest9', 'VARCHAR', false, 100, null);
        $this->addColumn('left_eye_test10', 'LeftEyeTest10', 'VARCHAR', false, 100, null);
        $this->addColumn('left_eye_test11', 'LeftEyeTest11', 'VARCHAR', false, 100, null);
        $this->addColumn('left_eye_test12', 'LeftEyeTest12', 'VARCHAR', false, 100, null);
        $this->addColumn('Signature', 'Signature', 'VARCHAR', false, 100, null);
        $this->addColumn('Examination_date', 'ExaminationDate', 'DATE', false, null, null);
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
    } // buildRelations()

    /**
     * Retrieves a string version of the primary key from the DB resultset row that can be used to uniquely identify a row in this table.
     *
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, a serialize()d version of the primary key will be returned.
     *
     * @param array  $row       resultset row.
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM
     *
     * @return string The primary key hash of the row
     */
    public static function getPrimaryKeyHashFromRow($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        // If the PK cannot be derived from the row, return NULL.
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)];
    }

    /**
     * Retrieves the primary key from the DB resultset row
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, an array of the primary key columns will be returned.
     *
     * @param array  $row       resultset row.
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM
     *
     * @return mixed The primary key of the row
     */
    public static function getPrimaryKeyFromRow($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        return (int) $row[
            $indexType == TableMap::TYPE_NUM
                ? 0 + $offset
                : self::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)
        ];
    }

    /**
     * The class that the tableMap will make instances of.
     *
     * If $withPrefix is true, the returned path
     * uses a dot-path notation which is translated into a path
     * relative to a location on the PHP include_path.
     * (e.g. path.to.MyClass -> 'path/to/MyClass.php')
     *
     * @param boolean $withPrefix Whether or not to return the path with the class name
     * @return string path.to.ClassName
     */
    public static function getOMClass($withPrefix = true)
    {
        return $withPrefix ? CareTzEyeTraumaTableMap::CLASS_DEFAULT : CareTzEyeTraumaTableMap::OM_CLASS;
    }

    /**
     * Populates an object of the default type or an object that inherit from the default.
     *
     * @param array  $row       row returned by DataFetcher->fetch().
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType The index type of $row. Mostly DataFetcher->getIndexType().
                                 One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     * @return array           (CareTzEyeTrauma object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = CareTzEyeTraumaTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = CareTzEyeTraumaTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + CareTzEyeTraumaTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = CareTzEyeTraumaTableMap::OM_CLASS;
            /** @var CareTzEyeTrauma $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            CareTzEyeTraumaTableMap::addInstanceToPool($obj, $key);
        }

        return array($obj, $col);
    }

    /**
     * The returned array will contain objects of the default type or
     * objects that inherit from the default.
     *
     * @param DataFetcherInterface $dataFetcher
     * @return array
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function populateObjects(DataFetcherInterface $dataFetcher)
    {
        $results = array();

        // set the class once to avoid overhead in the loop
        $cls = static::getOMClass(false);
        // populate the object(s)
        while ($row = $dataFetcher->fetch()) {
            $key = CareTzEyeTraumaTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = CareTzEyeTraumaTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var CareTzEyeTrauma $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                CareTzEyeTraumaTableMap::addInstanceToPool($obj, $key);
            } // if key exists
        }

        return $results;
    }
    /**
     * Add all the columns needed to create a new object.
     *
     * Note: any columns that were marked with lazyLoad="true" in the
     * XML schema will not be added to the select list and only loaded
     * on demand.
     *
     * @param Criteria $criteria object containing the columns to add.
     * @param string   $alias    optional table alias
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function addSelectColumns(Criteria $criteria, $alias = null)
    {
        if (null === $alias) {
            $criteria->addSelectColumn(CareTzEyeTraumaTableMap::COL_ID);
            $criteria->addSelectColumn(CareTzEyeTraumaTableMap::COL_PID);
            $criteria->addSelectColumn(CareTzEyeTraumaTableMap::COL_RIGHT_EYE_TEST1);
            $criteria->addSelectColumn(CareTzEyeTraumaTableMap::COL_RIGHT_EYE_TEST2);
            $criteria->addSelectColumn(CareTzEyeTraumaTableMap::COL_RIGHT_EYE_TEST3);
            $criteria->addSelectColumn(CareTzEyeTraumaTableMap::COL_RIGHT_EYE_TEST4);
            $criteria->addSelectColumn(CareTzEyeTraumaTableMap::COL_RIGHT_EYE_TEST5);
            $criteria->addSelectColumn(CareTzEyeTraumaTableMap::COL_RIGHT_EYE_TEST6);
            $criteria->addSelectColumn(CareTzEyeTraumaTableMap::COL_RIGHT_EYE_TEST7);
            $criteria->addSelectColumn(CareTzEyeTraumaTableMap::COL_RIGHT_EYE_TEST8);
            $criteria->addSelectColumn(CareTzEyeTraumaTableMap::COL_RIGHT_EYE_TEST9);
            $criteria->addSelectColumn(CareTzEyeTraumaTableMap::COL_RIGHT_EYE_TEST10);
            $criteria->addSelectColumn(CareTzEyeTraumaTableMap::COL_RIGHT_EYE_TEST11);
            $criteria->addSelectColumn(CareTzEyeTraumaTableMap::COL_RIGHT_EYE_TEST12);
            $criteria->addSelectColumn(CareTzEyeTraumaTableMap::COL_LEFT_EYE_TEST1);
            $criteria->addSelectColumn(CareTzEyeTraumaTableMap::COL_LEFT_EYE_TEST2);
            $criteria->addSelectColumn(CareTzEyeTraumaTableMap::COL_LEFT_EYE_TEST3);
            $criteria->addSelectColumn(CareTzEyeTraumaTableMap::COL_LEFT_EYE_TEST4);
            $criteria->addSelectColumn(CareTzEyeTraumaTableMap::COL_LEFT_EYE_TEST5);
            $criteria->addSelectColumn(CareTzEyeTraumaTableMap::COL_LEFT_EYE_TEST6);
            $criteria->addSelectColumn(CareTzEyeTraumaTableMap::COL_LEFT_EYE_TEST7);
            $criteria->addSelectColumn(CareTzEyeTraumaTableMap::COL_LEFT_EYE_TEST8);
            $criteria->addSelectColumn(CareTzEyeTraumaTableMap::COL_LEFT_EYE_TEST9);
            $criteria->addSelectColumn(CareTzEyeTraumaTableMap::COL_LEFT_EYE_TEST10);
            $criteria->addSelectColumn(CareTzEyeTraumaTableMap::COL_LEFT_EYE_TEST11);
            $criteria->addSelectColumn(CareTzEyeTraumaTableMap::COL_LEFT_EYE_TEST12);
            $criteria->addSelectColumn(CareTzEyeTraumaTableMap::COL_SIGNATURE);
            $criteria->addSelectColumn(CareTzEyeTraumaTableMap::COL_EXAMINATION_DATE);
        } else {
            $criteria->addSelectColumn($alias . '.id');
            $criteria->addSelectColumn($alias . '.pid');
            $criteria->addSelectColumn($alias . '.right_eye_test1');
            $criteria->addSelectColumn($alias . '.right_eye_test2');
            $criteria->addSelectColumn($alias . '.right_eye_test3');
            $criteria->addSelectColumn($alias . '.right_eye_test4');
            $criteria->addSelectColumn($alias . '.right_eye_test5');
            $criteria->addSelectColumn($alias . '.right_eye_test6');
            $criteria->addSelectColumn($alias . '.right_eye_test7');
            $criteria->addSelectColumn($alias . '.right_eye_test8');
            $criteria->addSelectColumn($alias . '.right_eye_test9');
            $criteria->addSelectColumn($alias . '.right_eye_test10');
            $criteria->addSelectColumn($alias . '.right_eye_test11');
            $criteria->addSelectColumn($alias . '.right_eye_test12');
            $criteria->addSelectColumn($alias . '.left_eye_test1');
            $criteria->addSelectColumn($alias . '.left_eye_test2');
            $criteria->addSelectColumn($alias . '.left_eye_test3');
            $criteria->addSelectColumn($alias . '.left_eye_test4');
            $criteria->addSelectColumn($alias . '.left_eye_test5');
            $criteria->addSelectColumn($alias . '.left_eye_test6');
            $criteria->addSelectColumn($alias . '.left_eye_test7');
            $criteria->addSelectColumn($alias . '.left_eye_test8');
            $criteria->addSelectColumn($alias . '.left_eye_test9');
            $criteria->addSelectColumn($alias . '.left_eye_test10');
            $criteria->addSelectColumn($alias . '.left_eye_test11');
            $criteria->addSelectColumn($alias . '.left_eye_test12');
            $criteria->addSelectColumn($alias . '.Signature');
            $criteria->addSelectColumn($alias . '.Examination_date');
        }
    }

    /**
     * Returns the TableMap related to this object.
     * This method is not needed for general use but a specific application could have a need.
     * @return TableMap
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function getTableMap()
    {
        return Propel::getServiceContainer()->getDatabaseMap(CareTzEyeTraumaTableMap::DATABASE_NAME)->getTable(CareTzEyeTraumaTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(CareTzEyeTraumaTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(CareTzEyeTraumaTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new CareTzEyeTraumaTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a CareTzEyeTrauma or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or CareTzEyeTrauma object or primary key or array of primary keys
     *              which is used to create the DELETE statement
     * @param  ConnectionInterface $con the connection to use
     * @return int             The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                         if supported by native driver or if emulated using Propel.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
     public static function doDelete($values, ConnectionInterface $con = null)
     {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(CareTzEyeTraumaTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \CareMd\CareMd\CareTzEyeTrauma) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(CareTzEyeTraumaTableMap::DATABASE_NAME);
            $criteria->add(CareTzEyeTraumaTableMap::COL_ID, (array) $values, Criteria::IN);
        }

        $query = CareTzEyeTraumaQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            CareTzEyeTraumaTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                CareTzEyeTraumaTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the care_tz_eye_trauma table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return CareTzEyeTraumaQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a CareTzEyeTrauma or Criteria object.
     *
     * @param mixed               $criteria Criteria or CareTzEyeTrauma object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(CareTzEyeTraumaTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from CareTzEyeTrauma object
        }

        if ($criteria->containsKey(CareTzEyeTraumaTableMap::COL_ID) && $criteria->keyContainsValue(CareTzEyeTraumaTableMap::COL_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.CareTzEyeTraumaTableMap::COL_ID.')');
        }


        // Set the correct dbName
        $query = CareTzEyeTraumaQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // CareTzEyeTraumaTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
CareTzEyeTraumaTableMap::buildTableMap();
