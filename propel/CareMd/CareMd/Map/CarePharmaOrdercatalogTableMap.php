<?php

namespace CareMd\CareMd\Map;

use CareMd\CareMd\CarePharmaOrdercatalog;
use CareMd\CareMd\CarePharmaOrdercatalogQuery;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\InstancePoolTrait;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\DataFetcher\DataFetcherInterface;
use Propel\Runtime\Exception\LogicException;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\RelationMap;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Map\TableMapTrait;


/**
 * This class defines the structure of the 'care_pharma_ordercatalog' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class CarePharmaOrdercatalogTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'CareMd.CareMd.Map.CarePharmaOrdercatalogTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'care_pharma_ordercatalog';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\CareMd\\CareMd\\CarePharmaOrdercatalog';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'CareMd.CareMd.CarePharmaOrdercatalog';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 8;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 8;

    /**
     * the column name for the item_no field
     */
    const COL_ITEM_NO = 'care_pharma_ordercatalog.item_no';

    /**
     * the column name for the dept_nr field
     */
    const COL_DEPT_NR = 'care_pharma_ordercatalog.dept_nr';

    /**
     * the column name for the hit field
     */
    const COL_HIT = 'care_pharma_ordercatalog.hit';

    /**
     * the column name for the artikelname field
     */
    const COL_ARTIKELNAME = 'care_pharma_ordercatalog.artikelname';

    /**
     * the column name for the bestellnum field
     */
    const COL_BESTELLNUM = 'care_pharma_ordercatalog.bestellnum';

    /**
     * the column name for the minorder field
     */
    const COL_MINORDER = 'care_pharma_ordercatalog.minorder';

    /**
     * the column name for the maxorder field
     */
    const COL_MAXORDER = 'care_pharma_ordercatalog.maxorder';

    /**
     * the column name for the proorder field
     */
    const COL_PROORDER = 'care_pharma_ordercatalog.proorder';

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
        self::TYPE_PHPNAME       => array('ItemNo', 'DeptNr', 'Hit', 'Artikelname', 'Bestellnum', 'Minorder', 'Maxorder', 'Proorder', ),
        self::TYPE_CAMELNAME     => array('itemNo', 'deptNr', 'hit', 'artikelname', 'bestellnum', 'minorder', 'maxorder', 'proorder', ),
        self::TYPE_COLNAME       => array(CarePharmaOrdercatalogTableMap::COL_ITEM_NO, CarePharmaOrdercatalogTableMap::COL_DEPT_NR, CarePharmaOrdercatalogTableMap::COL_HIT, CarePharmaOrdercatalogTableMap::COL_ARTIKELNAME, CarePharmaOrdercatalogTableMap::COL_BESTELLNUM, CarePharmaOrdercatalogTableMap::COL_MINORDER, CarePharmaOrdercatalogTableMap::COL_MAXORDER, CarePharmaOrdercatalogTableMap::COL_PROORDER, ),
        self::TYPE_FIELDNAME     => array('item_no', 'dept_nr', 'hit', 'artikelname', 'bestellnum', 'minorder', 'maxorder', 'proorder', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('ItemNo' => 0, 'DeptNr' => 1, 'Hit' => 2, 'Artikelname' => 3, 'Bestellnum' => 4, 'Minorder' => 5, 'Maxorder' => 6, 'Proorder' => 7, ),
        self::TYPE_CAMELNAME     => array('itemNo' => 0, 'deptNr' => 1, 'hit' => 2, 'artikelname' => 3, 'bestellnum' => 4, 'minorder' => 5, 'maxorder' => 6, 'proorder' => 7, ),
        self::TYPE_COLNAME       => array(CarePharmaOrdercatalogTableMap::COL_ITEM_NO => 0, CarePharmaOrdercatalogTableMap::COL_DEPT_NR => 1, CarePharmaOrdercatalogTableMap::COL_HIT => 2, CarePharmaOrdercatalogTableMap::COL_ARTIKELNAME => 3, CarePharmaOrdercatalogTableMap::COL_BESTELLNUM => 4, CarePharmaOrdercatalogTableMap::COL_MINORDER => 5, CarePharmaOrdercatalogTableMap::COL_MAXORDER => 6, CarePharmaOrdercatalogTableMap::COL_PROORDER => 7, ),
        self::TYPE_FIELDNAME     => array('item_no' => 0, 'dept_nr' => 1, 'hit' => 2, 'artikelname' => 3, 'bestellnum' => 4, 'minorder' => 5, 'maxorder' => 6, 'proorder' => 7, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, )
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
        $this->setName('care_pharma_ordercatalog');
        $this->setPhpName('CarePharmaOrdercatalog');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\CareMd\\CareMd\\CarePharmaOrdercatalog');
        $this->setPackage('CareMd.CareMd');
        $this->setUseIdGenerator(true);
        // columns
        $this->addColumn('item_no', 'ItemNo', 'INTEGER', true, null, null);
        $this->addColumn('dept_nr', 'DeptNr', 'INTEGER', true, 3, 0);
        $this->addColumn('hit', 'Hit', 'INTEGER', true, null, 0);
        $this->addColumn('artikelname', 'Artikelname', 'VARCHAR', true, 255, null);
        $this->addColumn('bestellnum', 'Bestellnum', 'VARCHAR', true, 20, '');
        $this->addColumn('minorder', 'Minorder', 'INTEGER', true, 4, 0);
        $this->addColumn('maxorder', 'Maxorder', 'INTEGER', true, 4, 0);
        $this->addColumn('proorder', 'Proorder', 'VARCHAR', true, 255, null);
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
        return null;
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
        return '';
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
        return $withPrefix ? CarePharmaOrdercatalogTableMap::CLASS_DEFAULT : CarePharmaOrdercatalogTableMap::OM_CLASS;
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
     * @return array           (CarePharmaOrdercatalog object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = CarePharmaOrdercatalogTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = CarePharmaOrdercatalogTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + CarePharmaOrdercatalogTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = CarePharmaOrdercatalogTableMap::OM_CLASS;
            /** @var CarePharmaOrdercatalog $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            CarePharmaOrdercatalogTableMap::addInstanceToPool($obj, $key);
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
            $key = CarePharmaOrdercatalogTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = CarePharmaOrdercatalogTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var CarePharmaOrdercatalog $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                CarePharmaOrdercatalogTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(CarePharmaOrdercatalogTableMap::COL_ITEM_NO);
            $criteria->addSelectColumn(CarePharmaOrdercatalogTableMap::COL_DEPT_NR);
            $criteria->addSelectColumn(CarePharmaOrdercatalogTableMap::COL_HIT);
            $criteria->addSelectColumn(CarePharmaOrdercatalogTableMap::COL_ARTIKELNAME);
            $criteria->addSelectColumn(CarePharmaOrdercatalogTableMap::COL_BESTELLNUM);
            $criteria->addSelectColumn(CarePharmaOrdercatalogTableMap::COL_MINORDER);
            $criteria->addSelectColumn(CarePharmaOrdercatalogTableMap::COL_MAXORDER);
            $criteria->addSelectColumn(CarePharmaOrdercatalogTableMap::COL_PROORDER);
        } else {
            $criteria->addSelectColumn($alias . '.item_no');
            $criteria->addSelectColumn($alias . '.dept_nr');
            $criteria->addSelectColumn($alias . '.hit');
            $criteria->addSelectColumn($alias . '.artikelname');
            $criteria->addSelectColumn($alias . '.bestellnum');
            $criteria->addSelectColumn($alias . '.minorder');
            $criteria->addSelectColumn($alias . '.maxorder');
            $criteria->addSelectColumn($alias . '.proorder');
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
        return Propel::getServiceContainer()->getDatabaseMap(CarePharmaOrdercatalogTableMap::DATABASE_NAME)->getTable(CarePharmaOrdercatalogTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(CarePharmaOrdercatalogTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(CarePharmaOrdercatalogTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new CarePharmaOrdercatalogTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a CarePharmaOrdercatalog or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or CarePharmaOrdercatalog object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(CarePharmaOrdercatalogTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \CareMd\CareMd\CarePharmaOrdercatalog) { // it's a model object
            // create criteria based on pk value
            $criteria = $values->buildCriteria();
        } else { // it's a primary key, or an array of pks
            throw new LogicException('The CarePharmaOrdercatalog object has no primary key');
        }

        $query = CarePharmaOrdercatalogQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            CarePharmaOrdercatalogTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                CarePharmaOrdercatalogTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the care_pharma_ordercatalog table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return CarePharmaOrdercatalogQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a CarePharmaOrdercatalog or Criteria object.
     *
     * @param mixed               $criteria Criteria or CarePharmaOrdercatalog object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(CarePharmaOrdercatalogTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from CarePharmaOrdercatalog object
        }


        // Set the correct dbName
        $query = CarePharmaOrdercatalogQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // CarePharmaOrdercatalogTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
CarePharmaOrdercatalogTableMap::buildTableMap();
