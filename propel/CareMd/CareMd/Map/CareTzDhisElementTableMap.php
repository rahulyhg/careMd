<?php

namespace CareMd\CareMd\Map;

use CareMd\CareMd\CareTzDhisElement;
use CareMd\CareMd\CareTzDhisElementQuery;
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
 * This class defines the structure of the 'care_tz_dhis_element' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class CareTzDhisElementTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'CareMd.CareMd.Map.CareTzDhisElementTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'care_tz_dhis_element';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\CareMd\\CareMd\\CareTzDhisElement';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'CareMd.CareMd.CareTzDhisElement';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 9;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 9;

    /**
     * the column name for the codeid field
     */
    const COL_CODEID = 'care_tz_dhis_element.codeid';

    /**
     * the column name for the icd_code field
     */
    const COL_ICD_CODE = 'care_tz_dhis_element.icd_code';

    /**
     * the column name for the dataelement_id field
     */
    const COL_DATAELEMENT_ID = 'care_tz_dhis_element.dataelement_id';

    /**
     * the column name for the categoryid field
     */
    const COL_CATEGORYID = 'care_tz_dhis_element.categoryid';

    /**
     * the column name for the optionid field
     */
    const COL_OPTIONID = 'care_tz_dhis_element.optionid';

    /**
     * the column name for the icd_desease_name field
     */
    const COL_ICD_DESEASE_NAME = 'care_tz_dhis_element.icd_desease_name';

    /**
     * the column name for the dhis_dataelement field
     */
    const COL_DHIS_DATAELEMENT = 'care_tz_dhis_element.dhis_dataelement';

    /**
     * the column name for the dhis_under5 field
     */
    const COL_DHIS_UNDER5 = 'care_tz_dhis_element.dhis_under5';

    /**
     * the column name for the dhis_under5id field
     */
    const COL_DHIS_UNDER5ID = 'care_tz_dhis_element.dhis_under5id';

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
        self::TYPE_PHPNAME       => array('Codeid', 'IcdCode', 'DataelementId', 'Categoryid', 'Optionid', 'IcdDeseaseName', 'DhisDataelement', 'DhisUnder5', 'DhisUnder5id', ),
        self::TYPE_CAMELNAME     => array('codeid', 'icdCode', 'dataelementId', 'categoryid', 'optionid', 'icdDeseaseName', 'dhisDataelement', 'dhisUnder5', 'dhisUnder5id', ),
        self::TYPE_COLNAME       => array(CareTzDhisElementTableMap::COL_CODEID, CareTzDhisElementTableMap::COL_ICD_CODE, CareTzDhisElementTableMap::COL_DATAELEMENT_ID, CareTzDhisElementTableMap::COL_CATEGORYID, CareTzDhisElementTableMap::COL_OPTIONID, CareTzDhisElementTableMap::COL_ICD_DESEASE_NAME, CareTzDhisElementTableMap::COL_DHIS_DATAELEMENT, CareTzDhisElementTableMap::COL_DHIS_UNDER5, CareTzDhisElementTableMap::COL_DHIS_UNDER5ID, ),
        self::TYPE_FIELDNAME     => array('codeid', 'icd_code', 'dataelement_id', 'categoryid', 'optionid', 'icd_desease_name', 'dhis_dataelement', 'dhis_under5', 'dhis_under5id', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('Codeid' => 0, 'IcdCode' => 1, 'DataelementId' => 2, 'Categoryid' => 3, 'Optionid' => 4, 'IcdDeseaseName' => 5, 'DhisDataelement' => 6, 'DhisUnder5' => 7, 'DhisUnder5id' => 8, ),
        self::TYPE_CAMELNAME     => array('codeid' => 0, 'icdCode' => 1, 'dataelementId' => 2, 'categoryid' => 3, 'optionid' => 4, 'icdDeseaseName' => 5, 'dhisDataelement' => 6, 'dhisUnder5' => 7, 'dhisUnder5id' => 8, ),
        self::TYPE_COLNAME       => array(CareTzDhisElementTableMap::COL_CODEID => 0, CareTzDhisElementTableMap::COL_ICD_CODE => 1, CareTzDhisElementTableMap::COL_DATAELEMENT_ID => 2, CareTzDhisElementTableMap::COL_CATEGORYID => 3, CareTzDhisElementTableMap::COL_OPTIONID => 4, CareTzDhisElementTableMap::COL_ICD_DESEASE_NAME => 5, CareTzDhisElementTableMap::COL_DHIS_DATAELEMENT => 6, CareTzDhisElementTableMap::COL_DHIS_UNDER5 => 7, CareTzDhisElementTableMap::COL_DHIS_UNDER5ID => 8, ),
        self::TYPE_FIELDNAME     => array('codeid' => 0, 'icd_code' => 1, 'dataelement_id' => 2, 'categoryid' => 3, 'optionid' => 4, 'icd_desease_name' => 5, 'dhis_dataelement' => 6, 'dhis_under5' => 7, 'dhis_under5id' => 8, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, )
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
        $this->setName('care_tz_dhis_element');
        $this->setPhpName('CareTzDhisElement');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\CareMd\\CareMd\\CareTzDhisElement');
        $this->setPackage('CareMd.CareMd');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('codeid', 'Codeid', 'INTEGER', true, 10, null);
        $this->addColumn('icd_code', 'IcdCode', 'CHAR', false, 10, null);
        $this->addColumn('dataelement_id', 'DataelementId', 'INTEGER', false, 10, null);
        $this->addColumn('categoryid', 'Categoryid', 'INTEGER', true, null, null);
        $this->addColumn('optionid', 'Optionid', 'INTEGER', true, null, null);
        $this->addColumn('icd_desease_name', 'IcdDeseaseName', 'LONGVARCHAR', false, null, null);
        $this->addColumn('dhis_dataelement', 'DhisDataelement', 'LONGVARCHAR', false, null, null);
        $this->addColumn('dhis_under5', 'DhisUnder5', 'LONGVARCHAR', false, null, null);
        $this->addColumn('dhis_under5id', 'DhisUnder5id', 'INTEGER', false, 10, null);
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Codeid', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Codeid', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Codeid', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Codeid', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Codeid', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Codeid', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('Codeid', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? CareTzDhisElementTableMap::CLASS_DEFAULT : CareTzDhisElementTableMap::OM_CLASS;
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
     * @return array           (CareTzDhisElement object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = CareTzDhisElementTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = CareTzDhisElementTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + CareTzDhisElementTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = CareTzDhisElementTableMap::OM_CLASS;
            /** @var CareTzDhisElement $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            CareTzDhisElementTableMap::addInstanceToPool($obj, $key);
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
            $key = CareTzDhisElementTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = CareTzDhisElementTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var CareTzDhisElement $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                CareTzDhisElementTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(CareTzDhisElementTableMap::COL_CODEID);
            $criteria->addSelectColumn(CareTzDhisElementTableMap::COL_ICD_CODE);
            $criteria->addSelectColumn(CareTzDhisElementTableMap::COL_DATAELEMENT_ID);
            $criteria->addSelectColumn(CareTzDhisElementTableMap::COL_CATEGORYID);
            $criteria->addSelectColumn(CareTzDhisElementTableMap::COL_OPTIONID);
            $criteria->addSelectColumn(CareTzDhisElementTableMap::COL_ICD_DESEASE_NAME);
            $criteria->addSelectColumn(CareTzDhisElementTableMap::COL_DHIS_DATAELEMENT);
            $criteria->addSelectColumn(CareTzDhisElementTableMap::COL_DHIS_UNDER5);
            $criteria->addSelectColumn(CareTzDhisElementTableMap::COL_DHIS_UNDER5ID);
        } else {
            $criteria->addSelectColumn($alias . '.codeid');
            $criteria->addSelectColumn($alias . '.icd_code');
            $criteria->addSelectColumn($alias . '.dataelement_id');
            $criteria->addSelectColumn($alias . '.categoryid');
            $criteria->addSelectColumn($alias . '.optionid');
            $criteria->addSelectColumn($alias . '.icd_desease_name');
            $criteria->addSelectColumn($alias . '.dhis_dataelement');
            $criteria->addSelectColumn($alias . '.dhis_under5');
            $criteria->addSelectColumn($alias . '.dhis_under5id');
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
        return Propel::getServiceContainer()->getDatabaseMap(CareTzDhisElementTableMap::DATABASE_NAME)->getTable(CareTzDhisElementTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(CareTzDhisElementTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(CareTzDhisElementTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new CareTzDhisElementTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a CareTzDhisElement or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or CareTzDhisElement object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(CareTzDhisElementTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \CareMd\CareMd\CareTzDhisElement) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(CareTzDhisElementTableMap::DATABASE_NAME);
            $criteria->add(CareTzDhisElementTableMap::COL_CODEID, (array) $values, Criteria::IN);
        }

        $query = CareTzDhisElementQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            CareTzDhisElementTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                CareTzDhisElementTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the care_tz_dhis_element table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return CareTzDhisElementQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a CareTzDhisElement or Criteria object.
     *
     * @param mixed               $criteria Criteria or CareTzDhisElement object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(CareTzDhisElementTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from CareTzDhisElement object
        }

        if ($criteria->containsKey(CareTzDhisElementTableMap::COL_CODEID) && $criteria->keyContainsValue(CareTzDhisElementTableMap::COL_CODEID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.CareTzDhisElementTableMap::COL_CODEID.')');
        }


        // Set the correct dbName
        $query = CareTzDhisElementQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // CareTzDhisElementTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
CareTzDhisElementTableMap::buildTableMap();
