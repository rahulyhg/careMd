<?php

namespace propel\propel\Map;

use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\InstancePoolTrait;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\DataFetcher\DataFetcherInterface;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\RelationMap;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Map\TableMapTrait;
use propel\propel\CareTzArvStatusTxtCode;
use propel\propel\CareTzArvStatusTxtCodeQuery;


/**
 * This class defines the structure of the 'care_tz_arv_status_txt_code' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class CareTzArvStatusTxtCodeTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'propel.propel.Map.CareTzArvStatusTxtCodeTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'care_tz_arv_status_txt_code';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\propel\\propel\\CareTzArvStatusTxtCode';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'propel.propel.CareTzArvStatusTxtCode';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 5;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 5;

    /**
     * the column name for the care_tz_arv_status_txt_code_id field
     */
    const COL_CARE_TZ_ARV_STATUS_TXT_CODE_ID = 'care_tz_arv_status_txt_code.care_tz_arv_status_txt_code_id';

    /**
     * the column name for the code field
     */
    const COL_CODE = 'care_tz_arv_status_txt_code.code';

    /**
     * the column name for the description field
     */
    const COL_DESCRIPTION = 'care_tz_arv_status_txt_code.description';

    /**
     * the column name for the parent field
     */
    const COL_PARENT = 'care_tz_arv_status_txt_code.parent';

    /**
     * the column name for the other field
     */
    const COL_OTHER = 'care_tz_arv_status_txt_code.other';

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
        self::TYPE_PHPNAME       => array('CareTzArvStatusTxtCodeId', 'Code', 'Description', 'Parent', 'Other', ),
        self::TYPE_CAMELNAME     => array('careTzArvStatusTxtCodeId', 'code', 'description', 'parent', 'other', ),
        self::TYPE_COLNAME       => array(CareTzArvStatusTxtCodeTableMap::COL_CARE_TZ_ARV_STATUS_TXT_CODE_ID, CareTzArvStatusTxtCodeTableMap::COL_CODE, CareTzArvStatusTxtCodeTableMap::COL_DESCRIPTION, CareTzArvStatusTxtCodeTableMap::COL_PARENT, CareTzArvStatusTxtCodeTableMap::COL_OTHER, ),
        self::TYPE_FIELDNAME     => array('care_tz_arv_status_txt_code_id', 'code', 'description', 'parent', 'other', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('CareTzArvStatusTxtCodeId' => 0, 'Code' => 1, 'Description' => 2, 'Parent' => 3, 'Other' => 4, ),
        self::TYPE_CAMELNAME     => array('careTzArvStatusTxtCodeId' => 0, 'code' => 1, 'description' => 2, 'parent' => 3, 'other' => 4, ),
        self::TYPE_COLNAME       => array(CareTzArvStatusTxtCodeTableMap::COL_CARE_TZ_ARV_STATUS_TXT_CODE_ID => 0, CareTzArvStatusTxtCodeTableMap::COL_CODE => 1, CareTzArvStatusTxtCodeTableMap::COL_DESCRIPTION => 2, CareTzArvStatusTxtCodeTableMap::COL_PARENT => 3, CareTzArvStatusTxtCodeTableMap::COL_OTHER => 4, ),
        self::TYPE_FIELDNAME     => array('care_tz_arv_status_txt_code_id' => 0, 'code' => 1, 'description' => 2, 'parent' => 3, 'other' => 4, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, )
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
        $this->setName('care_tz_arv_status_txt_code');
        $this->setPhpName('CareTzArvStatusTxtCode');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\propel\\propel\\CareTzArvStatusTxtCode');
        $this->setPackage('propel.propel');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('care_tz_arv_status_txt_code_id', 'CareTzArvStatusTxtCodeId', 'BIGINT', true, 50, null);
        $this->addColumn('code', 'Code', 'TINYINT', false, 3, null);
        $this->addColumn('description', 'Description', 'VARCHAR', false, 100, null);
        $this->addColumn('parent', 'Parent', 'INTEGER', true, 4, null);
        $this->addColumn('other', 'Other', 'BOOLEAN', true, 1, null);
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('CareTzArvStatusTxtCodeId', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('CareTzArvStatusTxtCodeId', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('CareTzArvStatusTxtCodeId', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('CareTzArvStatusTxtCodeId', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('CareTzArvStatusTxtCodeId', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('CareTzArvStatusTxtCodeId', TableMap::TYPE_PHPNAME, $indexType)];
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
        return (string) $row[
            $indexType == TableMap::TYPE_NUM
                ? 0 + $offset
                : self::translateFieldName('CareTzArvStatusTxtCodeId', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? CareTzArvStatusTxtCodeTableMap::CLASS_DEFAULT : CareTzArvStatusTxtCodeTableMap::OM_CLASS;
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
     * @return array           (CareTzArvStatusTxtCode object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = CareTzArvStatusTxtCodeTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = CareTzArvStatusTxtCodeTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + CareTzArvStatusTxtCodeTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = CareTzArvStatusTxtCodeTableMap::OM_CLASS;
            /** @var CareTzArvStatusTxtCode $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            CareTzArvStatusTxtCodeTableMap::addInstanceToPool($obj, $key);
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
            $key = CareTzArvStatusTxtCodeTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = CareTzArvStatusTxtCodeTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var CareTzArvStatusTxtCode $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                CareTzArvStatusTxtCodeTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(CareTzArvStatusTxtCodeTableMap::COL_CARE_TZ_ARV_STATUS_TXT_CODE_ID);
            $criteria->addSelectColumn(CareTzArvStatusTxtCodeTableMap::COL_CODE);
            $criteria->addSelectColumn(CareTzArvStatusTxtCodeTableMap::COL_DESCRIPTION);
            $criteria->addSelectColumn(CareTzArvStatusTxtCodeTableMap::COL_PARENT);
            $criteria->addSelectColumn(CareTzArvStatusTxtCodeTableMap::COL_OTHER);
        } else {
            $criteria->addSelectColumn($alias . '.care_tz_arv_status_txt_code_id');
            $criteria->addSelectColumn($alias . '.code');
            $criteria->addSelectColumn($alias . '.description');
            $criteria->addSelectColumn($alias . '.parent');
            $criteria->addSelectColumn($alias . '.other');
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
        return Propel::getServiceContainer()->getDatabaseMap(CareTzArvStatusTxtCodeTableMap::DATABASE_NAME)->getTable(CareTzArvStatusTxtCodeTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(CareTzArvStatusTxtCodeTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(CareTzArvStatusTxtCodeTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new CareTzArvStatusTxtCodeTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a CareTzArvStatusTxtCode or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or CareTzArvStatusTxtCode object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(CareTzArvStatusTxtCodeTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \propel\propel\CareTzArvStatusTxtCode) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(CareTzArvStatusTxtCodeTableMap::DATABASE_NAME);
            $criteria->add(CareTzArvStatusTxtCodeTableMap::COL_CARE_TZ_ARV_STATUS_TXT_CODE_ID, (array) $values, Criteria::IN);
        }

        $query = CareTzArvStatusTxtCodeQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            CareTzArvStatusTxtCodeTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                CareTzArvStatusTxtCodeTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the care_tz_arv_status_txt_code table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return CareTzArvStatusTxtCodeQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a CareTzArvStatusTxtCode or Criteria object.
     *
     * @param mixed               $criteria Criteria or CareTzArvStatusTxtCode object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(CareTzArvStatusTxtCodeTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from CareTzArvStatusTxtCode object
        }

        if ($criteria->containsKey(CareTzArvStatusTxtCodeTableMap::COL_CARE_TZ_ARV_STATUS_TXT_CODE_ID) && $criteria->keyContainsValue(CareTzArvStatusTxtCodeTableMap::COL_CARE_TZ_ARV_STATUS_TXT_CODE_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.CareTzArvStatusTxtCodeTableMap::COL_CARE_TZ_ARV_STATUS_TXT_CODE_ID.')');
        }


        // Set the correct dbName
        $query = CareTzArvStatusTxtCodeQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // CareTzArvStatusTxtCodeTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
CareTzArvStatusTxtCodeTableMap::buildTableMap();
