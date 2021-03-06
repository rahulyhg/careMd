<?php

namespace CareMd\CareMd\Map;

use CareMd\CareMd\CareIcd10Es;
use CareMd\CareMd\CareIcd10EsQuery;
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
 * This class defines the structure of the 'care_icd10_es' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class CareIcd10EsTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'CareMd.CareMd.Map.CareIcd10EsTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'care_icd10_es';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\CareMd\\CareMd\\CareIcd10Es';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'CareMd.CareMd.CareIcd10Es';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 12;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 12;

    /**
     * the column name for the diagnosis_code field
     */
    const COL_DIAGNOSIS_CODE = 'care_icd10_es.diagnosis_code';

    /**
     * the column name for the description field
     */
    const COL_DESCRIPTION = 'care_icd10_es.description';

    /**
     * the column name for the class_sub field
     */
    const COL_CLASS_SUB = 'care_icd10_es.class_sub';

    /**
     * the column name for the type field
     */
    const COL_TYPE = 'care_icd10_es.type';

    /**
     * the column name for the inclusive field
     */
    const COL_INCLUSIVE = 'care_icd10_es.inclusive';

    /**
     * the column name for the exclusive field
     */
    const COL_EXCLUSIVE = 'care_icd10_es.exclusive';

    /**
     * the column name for the notes field
     */
    const COL_NOTES = 'care_icd10_es.notes';

    /**
     * the column name for the std_code field
     */
    const COL_STD_CODE = 'care_icd10_es.std_code';

    /**
     * the column name for the sub_level field
     */
    const COL_SUB_LEVEL = 'care_icd10_es.sub_level';

    /**
     * the column name for the remarks field
     */
    const COL_REMARKS = 'care_icd10_es.remarks';

    /**
     * the column name for the extra_codes field
     */
    const COL_EXTRA_CODES = 'care_icd10_es.extra_codes';

    /**
     * the column name for the extra_subclass field
     */
    const COL_EXTRA_SUBCLASS = 'care_icd10_es.extra_subclass';

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
        self::TYPE_PHPNAME       => array('DiagnosisCode', 'Description', 'ClassSub', 'Type', 'Inclusive', 'Exclusive', 'Notes', 'StdCode', 'SubLevel', 'Remarks', 'ExtraCodes', 'ExtraSubclass', ),
        self::TYPE_CAMELNAME     => array('diagnosisCode', 'description', 'classSub', 'type', 'inclusive', 'exclusive', 'notes', 'stdCode', 'subLevel', 'remarks', 'extraCodes', 'extraSubclass', ),
        self::TYPE_COLNAME       => array(CareIcd10EsTableMap::COL_DIAGNOSIS_CODE, CareIcd10EsTableMap::COL_DESCRIPTION, CareIcd10EsTableMap::COL_CLASS_SUB, CareIcd10EsTableMap::COL_TYPE, CareIcd10EsTableMap::COL_INCLUSIVE, CareIcd10EsTableMap::COL_EXCLUSIVE, CareIcd10EsTableMap::COL_NOTES, CareIcd10EsTableMap::COL_STD_CODE, CareIcd10EsTableMap::COL_SUB_LEVEL, CareIcd10EsTableMap::COL_REMARKS, CareIcd10EsTableMap::COL_EXTRA_CODES, CareIcd10EsTableMap::COL_EXTRA_SUBCLASS, ),
        self::TYPE_FIELDNAME     => array('diagnosis_code', 'description', 'class_sub', 'type', 'inclusive', 'exclusive', 'notes', 'std_code', 'sub_level', 'remarks', 'extra_codes', 'extra_subclass', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('DiagnosisCode' => 0, 'Description' => 1, 'ClassSub' => 2, 'Type' => 3, 'Inclusive' => 4, 'Exclusive' => 5, 'Notes' => 6, 'StdCode' => 7, 'SubLevel' => 8, 'Remarks' => 9, 'ExtraCodes' => 10, 'ExtraSubclass' => 11, ),
        self::TYPE_CAMELNAME     => array('diagnosisCode' => 0, 'description' => 1, 'classSub' => 2, 'type' => 3, 'inclusive' => 4, 'exclusive' => 5, 'notes' => 6, 'stdCode' => 7, 'subLevel' => 8, 'remarks' => 9, 'extraCodes' => 10, 'extraSubclass' => 11, ),
        self::TYPE_COLNAME       => array(CareIcd10EsTableMap::COL_DIAGNOSIS_CODE => 0, CareIcd10EsTableMap::COL_DESCRIPTION => 1, CareIcd10EsTableMap::COL_CLASS_SUB => 2, CareIcd10EsTableMap::COL_TYPE => 3, CareIcd10EsTableMap::COL_INCLUSIVE => 4, CareIcd10EsTableMap::COL_EXCLUSIVE => 5, CareIcd10EsTableMap::COL_NOTES => 6, CareIcd10EsTableMap::COL_STD_CODE => 7, CareIcd10EsTableMap::COL_SUB_LEVEL => 8, CareIcd10EsTableMap::COL_REMARKS => 9, CareIcd10EsTableMap::COL_EXTRA_CODES => 10, CareIcd10EsTableMap::COL_EXTRA_SUBCLASS => 11, ),
        self::TYPE_FIELDNAME     => array('diagnosis_code' => 0, 'description' => 1, 'class_sub' => 2, 'type' => 3, 'inclusive' => 4, 'exclusive' => 5, 'notes' => 6, 'std_code' => 7, 'sub_level' => 8, 'remarks' => 9, 'extra_codes' => 10, 'extra_subclass' => 11, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, )
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
        $this->setName('care_icd10_es');
        $this->setPhpName('CareIcd10Es');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\CareMd\\CareMd\\CareIcd10Es');
        $this->setPackage('CareMd.CareMd');
        $this->setUseIdGenerator(false);
        // columns
        $this->addPrimaryKey('diagnosis_code', 'DiagnosisCode', 'VARCHAR', true, 12, '');
        $this->addColumn('description', 'Description', 'LONGVARCHAR', true, null, null);
        $this->addColumn('class_sub', 'ClassSub', 'VARCHAR', true, 5, '');
        $this->addColumn('type', 'Type', 'VARCHAR', true, 10, '');
        $this->addColumn('inclusive', 'Inclusive', 'LONGVARCHAR', true, null, null);
        $this->addColumn('exclusive', 'Exclusive', 'LONGVARCHAR', true, null, null);
        $this->addColumn('notes', 'Notes', 'LONGVARCHAR', true, null, null);
        $this->addColumn('std_code', 'StdCode', 'CHAR', true, null, '');
        $this->addColumn('sub_level', 'SubLevel', 'TINYINT', true, null, 0);
        $this->addColumn('remarks', 'Remarks', 'LONGVARCHAR', true, null, null);
        $this->addColumn('extra_codes', 'ExtraCodes', 'LONGVARCHAR', true, null, null);
        $this->addColumn('extra_subclass', 'ExtraSubclass', 'LONGVARCHAR', true, null, null);
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('DiagnosisCode', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('DiagnosisCode', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('DiagnosisCode', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('DiagnosisCode', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('DiagnosisCode', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('DiagnosisCode', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('DiagnosisCode', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? CareIcd10EsTableMap::CLASS_DEFAULT : CareIcd10EsTableMap::OM_CLASS;
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
     * @return array           (CareIcd10Es object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = CareIcd10EsTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = CareIcd10EsTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + CareIcd10EsTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = CareIcd10EsTableMap::OM_CLASS;
            /** @var CareIcd10Es $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            CareIcd10EsTableMap::addInstanceToPool($obj, $key);
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
            $key = CareIcd10EsTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = CareIcd10EsTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var CareIcd10Es $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                CareIcd10EsTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(CareIcd10EsTableMap::COL_DIAGNOSIS_CODE);
            $criteria->addSelectColumn(CareIcd10EsTableMap::COL_DESCRIPTION);
            $criteria->addSelectColumn(CareIcd10EsTableMap::COL_CLASS_SUB);
            $criteria->addSelectColumn(CareIcd10EsTableMap::COL_TYPE);
            $criteria->addSelectColumn(CareIcd10EsTableMap::COL_INCLUSIVE);
            $criteria->addSelectColumn(CareIcd10EsTableMap::COL_EXCLUSIVE);
            $criteria->addSelectColumn(CareIcd10EsTableMap::COL_NOTES);
            $criteria->addSelectColumn(CareIcd10EsTableMap::COL_STD_CODE);
            $criteria->addSelectColumn(CareIcd10EsTableMap::COL_SUB_LEVEL);
            $criteria->addSelectColumn(CareIcd10EsTableMap::COL_REMARKS);
            $criteria->addSelectColumn(CareIcd10EsTableMap::COL_EXTRA_CODES);
            $criteria->addSelectColumn(CareIcd10EsTableMap::COL_EXTRA_SUBCLASS);
        } else {
            $criteria->addSelectColumn($alias . '.diagnosis_code');
            $criteria->addSelectColumn($alias . '.description');
            $criteria->addSelectColumn($alias . '.class_sub');
            $criteria->addSelectColumn($alias . '.type');
            $criteria->addSelectColumn($alias . '.inclusive');
            $criteria->addSelectColumn($alias . '.exclusive');
            $criteria->addSelectColumn($alias . '.notes');
            $criteria->addSelectColumn($alias . '.std_code');
            $criteria->addSelectColumn($alias . '.sub_level');
            $criteria->addSelectColumn($alias . '.remarks');
            $criteria->addSelectColumn($alias . '.extra_codes');
            $criteria->addSelectColumn($alias . '.extra_subclass');
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
        return Propel::getServiceContainer()->getDatabaseMap(CareIcd10EsTableMap::DATABASE_NAME)->getTable(CareIcd10EsTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(CareIcd10EsTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(CareIcd10EsTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new CareIcd10EsTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a CareIcd10Es or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or CareIcd10Es object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(CareIcd10EsTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \CareMd\CareMd\CareIcd10Es) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(CareIcd10EsTableMap::DATABASE_NAME);
            $criteria->add(CareIcd10EsTableMap::COL_DIAGNOSIS_CODE, (array) $values, Criteria::IN);
        }

        $query = CareIcd10EsQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            CareIcd10EsTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                CareIcd10EsTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the care_icd10_es table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return CareIcd10EsQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a CareIcd10Es or Criteria object.
     *
     * @param mixed               $criteria Criteria or CareIcd10Es object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(CareIcd10EsTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from CareIcd10Es object
        }


        // Set the correct dbName
        $query = CareIcd10EsQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // CareIcd10EsTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
CareIcd10EsTableMap::buildTableMap();
