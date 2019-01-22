<?php

namespace CareMd\CareMd\Base;

use \Exception;
use \PDO;
use CareMd\CareMd\CareTzDistrict as ChildCareTzDistrict;
use CareMd\CareMd\CareTzDistrictQuery as ChildCareTzDistrictQuery;
use CareMd\CareMd\Map\CareTzDistrictTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'care_tz_district' table.
 *
 *
 *
 * @method     ChildCareTzDistrictQuery orderByDistrictId($order = Criteria::ASC) Order by the district_id column
 * @method     ChildCareTzDistrictQuery orderByDistrictCode($order = Criteria::ASC) Order by the district_code column
 * @method     ChildCareTzDistrictQuery orderByDistrictName($order = Criteria::ASC) Order by the district_name column
 * @method     ChildCareTzDistrictQuery orderByIsAdditional($order = Criteria::ASC) Order by the is_additional column
 *
 * @method     ChildCareTzDistrictQuery groupByDistrictId() Group by the district_id column
 * @method     ChildCareTzDistrictQuery groupByDistrictCode() Group by the district_code column
 * @method     ChildCareTzDistrictQuery groupByDistrictName() Group by the district_name column
 * @method     ChildCareTzDistrictQuery groupByIsAdditional() Group by the is_additional column
 *
 * @method     ChildCareTzDistrictQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildCareTzDistrictQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildCareTzDistrictQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildCareTzDistrictQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildCareTzDistrictQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildCareTzDistrictQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildCareTzDistrict findOne(ConnectionInterface $con = null) Return the first ChildCareTzDistrict matching the query
 * @method     ChildCareTzDistrict findOneOrCreate(ConnectionInterface $con = null) Return the first ChildCareTzDistrict matching the query, or a new ChildCareTzDistrict object populated from the query conditions when no match is found
 *
 * @method     ChildCareTzDistrict findOneByDistrictId(int $district_id) Return the first ChildCareTzDistrict filtered by the district_id column
 * @method     ChildCareTzDistrict findOneByDistrictCode(int $district_code) Return the first ChildCareTzDistrict filtered by the district_code column
 * @method     ChildCareTzDistrict findOneByDistrictName(string $district_name) Return the first ChildCareTzDistrict filtered by the district_name column
 * @method     ChildCareTzDistrict findOneByIsAdditional(int $is_additional) Return the first ChildCareTzDistrict filtered by the is_additional column *

 * @method     ChildCareTzDistrict requirePk($key, ConnectionInterface $con = null) Return the ChildCareTzDistrict by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCareTzDistrict requireOne(ConnectionInterface $con = null) Return the first ChildCareTzDistrict matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildCareTzDistrict requireOneByDistrictId(int $district_id) Return the first ChildCareTzDistrict filtered by the district_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCareTzDistrict requireOneByDistrictCode(int $district_code) Return the first ChildCareTzDistrict filtered by the district_code column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCareTzDistrict requireOneByDistrictName(string $district_name) Return the first ChildCareTzDistrict filtered by the district_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCareTzDistrict requireOneByIsAdditional(int $is_additional) Return the first ChildCareTzDistrict filtered by the is_additional column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildCareTzDistrict[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildCareTzDistrict objects based on current ModelCriteria
 * @method     ChildCareTzDistrict[]|ObjectCollection findByDistrictId(int $district_id) Return ChildCareTzDistrict objects filtered by the district_id column
 * @method     ChildCareTzDistrict[]|ObjectCollection findByDistrictCode(int $district_code) Return ChildCareTzDistrict objects filtered by the district_code column
 * @method     ChildCareTzDistrict[]|ObjectCollection findByDistrictName(string $district_name) Return ChildCareTzDistrict objects filtered by the district_name column
 * @method     ChildCareTzDistrict[]|ObjectCollection findByIsAdditional(int $is_additional) Return ChildCareTzDistrict objects filtered by the is_additional column
 * @method     ChildCareTzDistrict[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class CareTzDistrictQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \CareMd\CareMd\Base\CareTzDistrictQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\CareMd\\CareMd\\CareTzDistrict', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildCareTzDistrictQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildCareTzDistrictQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildCareTzDistrictQuery) {
            return $criteria;
        }
        $query = new ChildCareTzDistrictQuery();
        if (null !== $modelAlias) {
            $query->setModelAlias($modelAlias);
        }
        if ($criteria instanceof Criteria) {
            $query->mergeWith($criteria);
        }

        return $query;
    }

    /**
     * Find object by primary key.
     * Propel uses the instance pool to skip the database if the object exists.
     * Go fast if the query is untouched.
     *
     * <code>
     * $obj  = $c->findPk(12, $con);
     * </code>
     *
     * @param mixed $key Primary key to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return ChildCareTzDistrict|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(CareTzDistrictTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = CareTzDistrictTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
            // the object is already in the instance pool
            return $obj;
        }

        return $this->findPkSimple($key, $con);
    }

    /**
     * Find object by primary key using raw SQL to go fast.
     * Bypass doSelect() and the object formatter by using generated code.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     ConnectionInterface $con A connection object
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildCareTzDistrict A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT district_id, district_code, district_name, is_additional FROM care_tz_district WHERE district_id = :p0';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key, PDO::PARAM_INT);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), 0, $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(\PDO::FETCH_NUM)) {
            /** @var ChildCareTzDistrict $obj */
            $obj = new ChildCareTzDistrict();
            $obj->hydrate($row);
            CareTzDistrictTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
        }
        $stmt->closeCursor();

        return $obj;
    }

    /**
     * Find object by primary key.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     ConnectionInterface $con A connection object
     *
     * @return ChildCareTzDistrict|array|mixed the result, formatted by the current formatter
     */
    protected function findPkComplex($key, ConnectionInterface $con)
    {
        // As the query uses a PK condition, no limit(1) is necessary.
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKey($key)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->formatOne($dataFetcher);
    }

    /**
     * Find objects by primary key
     * <code>
     * $objs = $c->findPks(array(12, 56, 832), $con);
     * </code>
     * @param     array $keys Primary keys to use for the query
     * @param     ConnectionInterface $con an optional connection object
     *
     * @return ObjectCollection|array|mixed the list of results, formatted by the current formatter
     */
    public function findPks($keys, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getReadConnection($this->getDbName());
        }
        $this->basePreSelect($con);
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKeys($keys)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->format($dataFetcher);
    }

    /**
     * Filter the query by primary key
     *
     * @param     mixed $key Primary key to use for the query
     *
     * @return $this|ChildCareTzDistrictQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(CareTzDistrictTableMap::COL_DISTRICT_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildCareTzDistrictQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(CareTzDistrictTableMap::COL_DISTRICT_ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the district_id column
     *
     * Example usage:
     * <code>
     * $query->filterByDistrictId(1234); // WHERE district_id = 1234
     * $query->filterByDistrictId(array(12, 34)); // WHERE district_id IN (12, 34)
     * $query->filterByDistrictId(array('min' => 12)); // WHERE district_id > 12
     * </code>
     *
     * @param     mixed $districtId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCareTzDistrictQuery The current query, for fluid interface
     */
    public function filterByDistrictId($districtId = null, $comparison = null)
    {
        if (is_array($districtId)) {
            $useMinMax = false;
            if (isset($districtId['min'])) {
                $this->addUsingAlias(CareTzDistrictTableMap::COL_DISTRICT_ID, $districtId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($districtId['max'])) {
                $this->addUsingAlias(CareTzDistrictTableMap::COL_DISTRICT_ID, $districtId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CareTzDistrictTableMap::COL_DISTRICT_ID, $districtId, $comparison);
    }

    /**
     * Filter the query on the district_code column
     *
     * Example usage:
     * <code>
     * $query->filterByDistrictCode(1234); // WHERE district_code = 1234
     * $query->filterByDistrictCode(array(12, 34)); // WHERE district_code IN (12, 34)
     * $query->filterByDistrictCode(array('min' => 12)); // WHERE district_code > 12
     * </code>
     *
     * @param     mixed $districtCode The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCareTzDistrictQuery The current query, for fluid interface
     */
    public function filterByDistrictCode($districtCode = null, $comparison = null)
    {
        if (is_array($districtCode)) {
            $useMinMax = false;
            if (isset($districtCode['min'])) {
                $this->addUsingAlias(CareTzDistrictTableMap::COL_DISTRICT_CODE, $districtCode['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($districtCode['max'])) {
                $this->addUsingAlias(CareTzDistrictTableMap::COL_DISTRICT_CODE, $districtCode['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CareTzDistrictTableMap::COL_DISTRICT_CODE, $districtCode, $comparison);
    }

    /**
     * Filter the query on the district_name column
     *
     * Example usage:
     * <code>
     * $query->filterByDistrictName('fooValue');   // WHERE district_name = 'fooValue'
     * $query->filterByDistrictName('%fooValue%', Criteria::LIKE); // WHERE district_name LIKE '%fooValue%'
     * </code>
     *
     * @param     string $districtName The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCareTzDistrictQuery The current query, for fluid interface
     */
    public function filterByDistrictName($districtName = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($districtName)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CareTzDistrictTableMap::COL_DISTRICT_NAME, $districtName, $comparison);
    }

    /**
     * Filter the query on the is_additional column
     *
     * Example usage:
     * <code>
     * $query->filterByIsAdditional(1234); // WHERE is_additional = 1234
     * $query->filterByIsAdditional(array(12, 34)); // WHERE is_additional IN (12, 34)
     * $query->filterByIsAdditional(array('min' => 12)); // WHERE is_additional > 12
     * </code>
     *
     * @param     mixed $isAdditional The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCareTzDistrictQuery The current query, for fluid interface
     */
    public function filterByIsAdditional($isAdditional = null, $comparison = null)
    {
        if (is_array($isAdditional)) {
            $useMinMax = false;
            if (isset($isAdditional['min'])) {
                $this->addUsingAlias(CareTzDistrictTableMap::COL_IS_ADDITIONAL, $isAdditional['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($isAdditional['max'])) {
                $this->addUsingAlias(CareTzDistrictTableMap::COL_IS_ADDITIONAL, $isAdditional['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CareTzDistrictTableMap::COL_IS_ADDITIONAL, $isAdditional, $comparison);
    }

    /**
     * Exclude object from result
     *
     * @param   ChildCareTzDistrict $careTzDistrict Object to remove from the list of results
     *
     * @return $this|ChildCareTzDistrictQuery The current query, for fluid interface
     */
    public function prune($careTzDistrict = null)
    {
        if ($careTzDistrict) {
            $this->addUsingAlias(CareTzDistrictTableMap::COL_DISTRICT_ID, $careTzDistrict->getDistrictId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the care_tz_district table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(CareTzDistrictTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            CareTzDistrictTableMap::clearInstancePool();
            CareTzDistrictTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

    /**
     * Performs a DELETE on the database based on the current ModelCriteria
     *
     * @param ConnectionInterface $con the connection to use
     * @return int             The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                         if supported by native driver or if emulated using Propel.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public function delete(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(CareTzDistrictTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(CareTzDistrictTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            CareTzDistrictTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            CareTzDistrictTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // CareTzDistrictQuery
