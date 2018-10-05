<?php

namespace propel\propel\Base;

use \Exception;
use \PDO;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;
use propel\propel\CareTzArvEducationTopic as ChildCareTzArvEducationTopic;
use propel\propel\CareTzArvEducationTopicQuery as ChildCareTzArvEducationTopicQuery;
use propel\propel\Map\CareTzArvEducationTopicTableMap;

/**
 * Base class that represents a query for the 'care_tz_arv_education_topic' table.
 *
 *
 *
 * @method     ChildCareTzArvEducationTopicQuery orderByCareTzArvEducationTopicId($order = Criteria::ASC) Order by the care_tz_arv_education_topic_id column
 * @method     ChildCareTzArvEducationTopicQuery orderByCareTzArvEducationGroupId($order = Criteria::ASC) Order by the care_tz_arv_education_group_id column
 * @method     ChildCareTzArvEducationTopicQuery orderByDescription($order = Criteria::ASC) Order by the description column
 *
 * @method     ChildCareTzArvEducationTopicQuery groupByCareTzArvEducationTopicId() Group by the care_tz_arv_education_topic_id column
 * @method     ChildCareTzArvEducationTopicQuery groupByCareTzArvEducationGroupId() Group by the care_tz_arv_education_group_id column
 * @method     ChildCareTzArvEducationTopicQuery groupByDescription() Group by the description column
 *
 * @method     ChildCareTzArvEducationTopicQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildCareTzArvEducationTopicQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildCareTzArvEducationTopicQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildCareTzArvEducationTopicQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildCareTzArvEducationTopicQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildCareTzArvEducationTopicQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildCareTzArvEducationTopic findOne(ConnectionInterface $con = null) Return the first ChildCareTzArvEducationTopic matching the query
 * @method     ChildCareTzArvEducationTopic findOneOrCreate(ConnectionInterface $con = null) Return the first ChildCareTzArvEducationTopic matching the query, or a new ChildCareTzArvEducationTopic object populated from the query conditions when no match is found
 *
 * @method     ChildCareTzArvEducationTopic findOneByCareTzArvEducationTopicId(string $care_tz_arv_education_topic_id) Return the first ChildCareTzArvEducationTopic filtered by the care_tz_arv_education_topic_id column
 * @method     ChildCareTzArvEducationTopic findOneByCareTzArvEducationGroupId(int $care_tz_arv_education_group_id) Return the first ChildCareTzArvEducationTopic filtered by the care_tz_arv_education_group_id column
 * @method     ChildCareTzArvEducationTopic findOneByDescription(string $description) Return the first ChildCareTzArvEducationTopic filtered by the description column *

 * @method     ChildCareTzArvEducationTopic requirePk($key, ConnectionInterface $con = null) Return the ChildCareTzArvEducationTopic by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCareTzArvEducationTopic requireOne(ConnectionInterface $con = null) Return the first ChildCareTzArvEducationTopic matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildCareTzArvEducationTopic requireOneByCareTzArvEducationTopicId(string $care_tz_arv_education_topic_id) Return the first ChildCareTzArvEducationTopic filtered by the care_tz_arv_education_topic_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCareTzArvEducationTopic requireOneByCareTzArvEducationGroupId(int $care_tz_arv_education_group_id) Return the first ChildCareTzArvEducationTopic filtered by the care_tz_arv_education_group_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCareTzArvEducationTopic requireOneByDescription(string $description) Return the first ChildCareTzArvEducationTopic filtered by the description column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildCareTzArvEducationTopic[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildCareTzArvEducationTopic objects based on current ModelCriteria
 * @method     ChildCareTzArvEducationTopic[]|ObjectCollection findByCareTzArvEducationTopicId(string $care_tz_arv_education_topic_id) Return ChildCareTzArvEducationTopic objects filtered by the care_tz_arv_education_topic_id column
 * @method     ChildCareTzArvEducationTopic[]|ObjectCollection findByCareTzArvEducationGroupId(int $care_tz_arv_education_group_id) Return ChildCareTzArvEducationTopic objects filtered by the care_tz_arv_education_group_id column
 * @method     ChildCareTzArvEducationTopic[]|ObjectCollection findByDescription(string $description) Return ChildCareTzArvEducationTopic objects filtered by the description column
 * @method     ChildCareTzArvEducationTopic[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class CareTzArvEducationTopicQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \propel\propel\Base\CareTzArvEducationTopicQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\propel\\propel\\CareTzArvEducationTopic', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildCareTzArvEducationTopicQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildCareTzArvEducationTopicQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildCareTzArvEducationTopicQuery) {
            return $criteria;
        }
        $query = new ChildCareTzArvEducationTopicQuery();
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
     * @return ChildCareTzArvEducationTopic|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(CareTzArvEducationTopicTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = CareTzArvEducationTopicTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildCareTzArvEducationTopic A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT care_tz_arv_education_topic_id, care_tz_arv_education_group_id, description FROM care_tz_arv_education_topic WHERE care_tz_arv_education_topic_id = :p0';
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
            /** @var ChildCareTzArvEducationTopic $obj */
            $obj = new ChildCareTzArvEducationTopic();
            $obj->hydrate($row);
            CareTzArvEducationTopicTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildCareTzArvEducationTopic|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildCareTzArvEducationTopicQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(CareTzArvEducationTopicTableMap::COL_CARE_TZ_ARV_EDUCATION_TOPIC_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildCareTzArvEducationTopicQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(CareTzArvEducationTopicTableMap::COL_CARE_TZ_ARV_EDUCATION_TOPIC_ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the care_tz_arv_education_topic_id column
     *
     * Example usage:
     * <code>
     * $query->filterByCareTzArvEducationTopicId(1234); // WHERE care_tz_arv_education_topic_id = 1234
     * $query->filterByCareTzArvEducationTopicId(array(12, 34)); // WHERE care_tz_arv_education_topic_id IN (12, 34)
     * $query->filterByCareTzArvEducationTopicId(array('min' => 12)); // WHERE care_tz_arv_education_topic_id > 12
     * </code>
     *
     * @param     mixed $careTzArvEducationTopicId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCareTzArvEducationTopicQuery The current query, for fluid interface
     */
    public function filterByCareTzArvEducationTopicId($careTzArvEducationTopicId = null, $comparison = null)
    {
        if (is_array($careTzArvEducationTopicId)) {
            $useMinMax = false;
            if (isset($careTzArvEducationTopicId['min'])) {
                $this->addUsingAlias(CareTzArvEducationTopicTableMap::COL_CARE_TZ_ARV_EDUCATION_TOPIC_ID, $careTzArvEducationTopicId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($careTzArvEducationTopicId['max'])) {
                $this->addUsingAlias(CareTzArvEducationTopicTableMap::COL_CARE_TZ_ARV_EDUCATION_TOPIC_ID, $careTzArvEducationTopicId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CareTzArvEducationTopicTableMap::COL_CARE_TZ_ARV_EDUCATION_TOPIC_ID, $careTzArvEducationTopicId, $comparison);
    }

    /**
     * Filter the query on the care_tz_arv_education_group_id column
     *
     * Example usage:
     * <code>
     * $query->filterByCareTzArvEducationGroupId(1234); // WHERE care_tz_arv_education_group_id = 1234
     * $query->filterByCareTzArvEducationGroupId(array(12, 34)); // WHERE care_tz_arv_education_group_id IN (12, 34)
     * $query->filterByCareTzArvEducationGroupId(array('min' => 12)); // WHERE care_tz_arv_education_group_id > 12
     * </code>
     *
     * @param     mixed $careTzArvEducationGroupId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCareTzArvEducationTopicQuery The current query, for fluid interface
     */
    public function filterByCareTzArvEducationGroupId($careTzArvEducationGroupId = null, $comparison = null)
    {
        if (is_array($careTzArvEducationGroupId)) {
            $useMinMax = false;
            if (isset($careTzArvEducationGroupId['min'])) {
                $this->addUsingAlias(CareTzArvEducationTopicTableMap::COL_CARE_TZ_ARV_EDUCATION_GROUP_ID, $careTzArvEducationGroupId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($careTzArvEducationGroupId['max'])) {
                $this->addUsingAlias(CareTzArvEducationTopicTableMap::COL_CARE_TZ_ARV_EDUCATION_GROUP_ID, $careTzArvEducationGroupId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CareTzArvEducationTopicTableMap::COL_CARE_TZ_ARV_EDUCATION_GROUP_ID, $careTzArvEducationGroupId, $comparison);
    }

    /**
     * Filter the query on the description column
     *
     * Example usage:
     * <code>
     * $query->filterByDescription('fooValue');   // WHERE description = 'fooValue'
     * $query->filterByDescription('%fooValue%', Criteria::LIKE); // WHERE description LIKE '%fooValue%'
     * </code>
     *
     * @param     string $description The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCareTzArvEducationTopicQuery The current query, for fluid interface
     */
    public function filterByDescription($description = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($description)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CareTzArvEducationTopicTableMap::COL_DESCRIPTION, $description, $comparison);
    }

    /**
     * Exclude object from result
     *
     * @param   ChildCareTzArvEducationTopic $careTzArvEducationTopic Object to remove from the list of results
     *
     * @return $this|ChildCareTzArvEducationTopicQuery The current query, for fluid interface
     */
    public function prune($careTzArvEducationTopic = null)
    {
        if ($careTzArvEducationTopic) {
            $this->addUsingAlias(CareTzArvEducationTopicTableMap::COL_CARE_TZ_ARV_EDUCATION_TOPIC_ID, $careTzArvEducationTopic->getCareTzArvEducationTopicId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the care_tz_arv_education_topic table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(CareTzArvEducationTopicTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            CareTzArvEducationTopicTableMap::clearInstancePool();
            CareTzArvEducationTopicTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(CareTzArvEducationTopicTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(CareTzArvEducationTopicTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            CareTzArvEducationTopicTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            CareTzArvEducationTopicTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // CareTzArvEducationTopicQuery
