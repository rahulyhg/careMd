<?php

namespace CareMd\CareMd\Map;

use CareMd\CareMd\CareMenuMain;
use CareMd\CareMd\CareMenuMainQuery;
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
 * This class defines the structure of the 'care_menu_main' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class CareMenuMainTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'CareMd.CareMd.Map.CareMenuMainTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'care_menu_main';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\CareMd\\CareMd\\CareMenuMain';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'CareMd.CareMd.CareMenuMain';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 10;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 10;

    /**
     * the column name for the nr field
     */
    const COL_NR = 'care_menu_main.nr';

    /**
     * the column name for the sort_nr field
     */
    const COL_SORT_NR = 'care_menu_main.sort_nr';

    /**
     * the column name for the name field
     */
    const COL_NAME = 'care_menu_main.name';

    /**
     * the column name for the LD_var field
     */
    const COL_LD_VAR = 'care_menu_main.LD_var';

    /**
     * the column name for the url field
     */
    const COL_URL = 'care_menu_main.url';

    /**
     * the column name for the is_visible field
     */
    const COL_IS_VISIBLE = 'care_menu_main.is_visible';

    /**
     * the column name for the hide_by field
     */
    const COL_HIDE_BY = 'care_menu_main.hide_by';

    /**
     * the column name for the status field
     */
    const COL_STATUS = 'care_menu_main.status';

    /**
     * the column name for the modify_id field
     */
    const COL_MODIFY_ID = 'care_menu_main.modify_id';

    /**
     * the column name for the modify_time field
     */
    const COL_MODIFY_TIME = 'care_menu_main.modify_time';

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
        self::TYPE_PHPNAME       => array('Nr', 'SortNr', 'Name', 'LdVar', 'Url', 'IsVisible', 'HideBy', 'Status', 'ModifyId', 'ModifyTime', ),
        self::TYPE_CAMELNAME     => array('nr', 'sortNr', 'name', 'ldVar', 'url', 'isVisible', 'hideBy', 'status', 'modifyId', 'modifyTime', ),
        self::TYPE_COLNAME       => array(CareMenuMainTableMap::COL_NR, CareMenuMainTableMap::COL_SORT_NR, CareMenuMainTableMap::COL_NAME, CareMenuMainTableMap::COL_LD_VAR, CareMenuMainTableMap::COL_URL, CareMenuMainTableMap::COL_IS_VISIBLE, CareMenuMainTableMap::COL_HIDE_BY, CareMenuMainTableMap::COL_STATUS, CareMenuMainTableMap::COL_MODIFY_ID, CareMenuMainTableMap::COL_MODIFY_TIME, ),
        self::TYPE_FIELDNAME     => array('nr', 'sort_nr', 'name', 'LD_var', 'url', 'is_visible', 'hide_by', 'status', 'modify_id', 'modify_time', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('Nr' => 0, 'SortNr' => 1, 'Name' => 2, 'LdVar' => 3, 'Url' => 4, 'IsVisible' => 5, 'HideBy' => 6, 'Status' => 7, 'ModifyId' => 8, 'ModifyTime' => 9, ),
        self::TYPE_CAMELNAME     => array('nr' => 0, 'sortNr' => 1, 'name' => 2, 'ldVar' => 3, 'url' => 4, 'isVisible' => 5, 'hideBy' => 6, 'status' => 7, 'modifyId' => 8, 'modifyTime' => 9, ),
        self::TYPE_COLNAME       => array(CareMenuMainTableMap::COL_NR => 0, CareMenuMainTableMap::COL_SORT_NR => 1, CareMenuMainTableMap::COL_NAME => 2, CareMenuMainTableMap::COL_LD_VAR => 3, CareMenuMainTableMap::COL_URL => 4, CareMenuMainTableMap::COL_IS_VISIBLE => 5, CareMenuMainTableMap::COL_HIDE_BY => 6, CareMenuMainTableMap::COL_STATUS => 7, CareMenuMainTableMap::COL_MODIFY_ID => 8, CareMenuMainTableMap::COL_MODIFY_TIME => 9, ),
        self::TYPE_FIELDNAME     => array('nr' => 0, 'sort_nr' => 1, 'name' => 2, 'LD_var' => 3, 'url' => 4, 'is_visible' => 5, 'hide_by' => 6, 'status' => 7, 'modify_id' => 8, 'modify_time' => 9, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, )
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
        $this->setName('care_menu_main');
        $this->setPhpName('CareMenuMain');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\CareMd\\CareMd\\CareMenuMain');
        $this->setPackage('CareMd.CareMd');
        $this->setUseIdGenerator(false);
        // columns
        $this->addPrimaryKey('nr', 'Nr', 'TINYINT', true, 3, 0);
        $this->addColumn('sort_nr', 'SortNr', 'TINYINT', true, 2, 0);
        $this->addColumn('name', 'Name', 'VARCHAR', true, 35, '');
        $this->addColumn('LD_var', 'LdVar', 'VARCHAR', true, 35, '');
        $this->addColumn('url', 'Url', 'VARCHAR', true, 255, '');
        $this->addColumn('is_visible', 'IsVisible', 'BOOLEAN', true, 1, true);
        $this->addColumn('hide_by', 'HideBy', 'LONGVARCHAR', false, null, null);
        $this->addColumn('status', 'Status', 'VARCHAR', true, 25, '');
        $this->addColumn('modify_id', 'ModifyId', 'TIMESTAMP', true, null, 'CURRENT_TIMESTAMP');
        $this->addColumn('modify_time', 'ModifyTime', 'TIMESTAMP', true, null, '0000-00-00 00:00:00');
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Nr', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Nr', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Nr', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Nr', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Nr', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Nr', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('Nr', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? CareMenuMainTableMap::CLASS_DEFAULT : CareMenuMainTableMap::OM_CLASS;
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
     * @return array           (CareMenuMain object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = CareMenuMainTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = CareMenuMainTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + CareMenuMainTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = CareMenuMainTableMap::OM_CLASS;
            /** @var CareMenuMain $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            CareMenuMainTableMap::addInstanceToPool($obj, $key);
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
            $key = CareMenuMainTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = CareMenuMainTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var CareMenuMain $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                CareMenuMainTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(CareMenuMainTableMap::COL_NR);
            $criteria->addSelectColumn(CareMenuMainTableMap::COL_SORT_NR);
            $criteria->addSelectColumn(CareMenuMainTableMap::COL_NAME);
            $criteria->addSelectColumn(CareMenuMainTableMap::COL_LD_VAR);
            $criteria->addSelectColumn(CareMenuMainTableMap::COL_URL);
            $criteria->addSelectColumn(CareMenuMainTableMap::COL_IS_VISIBLE);
            $criteria->addSelectColumn(CareMenuMainTableMap::COL_HIDE_BY);
            $criteria->addSelectColumn(CareMenuMainTableMap::COL_STATUS);
            $criteria->addSelectColumn(CareMenuMainTableMap::COL_MODIFY_ID);
            $criteria->addSelectColumn(CareMenuMainTableMap::COL_MODIFY_TIME);
        } else {
            $criteria->addSelectColumn($alias . '.nr');
            $criteria->addSelectColumn($alias . '.sort_nr');
            $criteria->addSelectColumn($alias . '.name');
            $criteria->addSelectColumn($alias . '.LD_var');
            $criteria->addSelectColumn($alias . '.url');
            $criteria->addSelectColumn($alias . '.is_visible');
            $criteria->addSelectColumn($alias . '.hide_by');
            $criteria->addSelectColumn($alias . '.status');
            $criteria->addSelectColumn($alias . '.modify_id');
            $criteria->addSelectColumn($alias . '.modify_time');
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
        return Propel::getServiceContainer()->getDatabaseMap(CareMenuMainTableMap::DATABASE_NAME)->getTable(CareMenuMainTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(CareMenuMainTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(CareMenuMainTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new CareMenuMainTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a CareMenuMain or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or CareMenuMain object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(CareMenuMainTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \CareMd\CareMd\CareMenuMain) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(CareMenuMainTableMap::DATABASE_NAME);
            $criteria->add(CareMenuMainTableMap::COL_NR, (array) $values, Criteria::IN);
        }

        $query = CareMenuMainQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            CareMenuMainTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                CareMenuMainTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the care_menu_main table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return CareMenuMainQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a CareMenuMain or Criteria object.
     *
     * @param mixed               $criteria Criteria or CareMenuMain object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(CareMenuMainTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from CareMenuMain object
        }


        // Set the correct dbName
        $query = CareMenuMainQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // CareMenuMainTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
CareMenuMainTableMap::buildTableMap();
