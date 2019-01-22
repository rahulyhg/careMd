<?php

namespace CareMd\CareMd\Base;

use \Exception;
use \PDO;
use CareMd\CareMd\CustomFieldSelectOptions as ChildCustomFieldSelectOptions;
use CareMd\CareMd\CustomFieldSelectOptionsQuery as ChildCustomFieldSelectOptionsQuery;
use CareMd\CareMd\Map\CustomFieldSelectOptionsTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'custom_field_select_options' table.
 *
 *
 *
 * @method     ChildCustomFieldSelectOptionsQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildCustomFieldSelectOptionsQuery orderByParentId($order = Criteria::ASC) Order by the parent_id column
 * @method     ChildCustomFieldSelectOptionsQuery orderByOptionValue($order = Criteria::ASC) Order by the option_value column
 * @method     ChildCustomFieldSelectOptionsQuery orderBySortNr($order = Criteria::ASC) Order by the sort_nr column
 *
 * @method     ChildCustomFieldSelectOptionsQuery groupById() Group by the id column
 * @method     ChildCustomFieldSelectOptionsQuery groupByParentId() Group by the parent_id column
 * @method     ChildCustomFieldSelectOptionsQuery groupByOptionValue() Group by the option_value column
 * @method     ChildCustomFieldSelectOptionsQuery groupBySortNr() Group by the sort_nr column
 *
 * @method     ChildCustomFieldSelectOptionsQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildCustomFieldSelectOptionsQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildCustomFieldSelectOptionsQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildCustomFieldSelectOptionsQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildCustomFieldSelectOptionsQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildCustomFieldSelectOptionsQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildCustomFieldSelectOptions findOne(ConnectionInterface $con = null) Return the first ChildCustomFieldSelectOptions matching the query
 * @method     ChildCustomFieldSelectOptions findOneOrCreate(ConnectionInterface $con = null) Return the first ChildCustomFieldSelectOptions matching the query, or a new ChildCustomFieldSelectOptions object populated from the query conditions when no match is found
 *
 * @method     ChildCustomFieldSelectOptions findOneById(int $id) Return the first ChildCustomFieldSelectOptions filtered by the id column
 * @method     ChildCustomFieldSelectOptions findOneByParentId(int $parent_id) Return the first ChildCustomFieldSelectOptions filtered by the parent_id column
 * @method     ChildCustomFieldSelectOptions findOneByOptionValue(string $option_value) Return the first ChildCustomFieldSelectOptions filtered by the option_value column
 * @method     ChildCustomFieldSelectOptions findOneBySortNr(int $sort_nr) Return the first ChildCustomFieldSelectOptions filtered by the sort_nr column *

 * @method     ChildCustomFieldSelectOptions requirePk($key, ConnectionInterface $con = null) Return the ChildCustomFieldSelectOptions by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCustomFieldSelectOptions requireOne(ConnectionInterface $con = null) Return the first ChildCustomFieldSelectOptions matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildCustomFieldSelectOptions requireOneById(int $id) Return the first ChildCustomFieldSelectOptions filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCustomFieldSelectOptions requireOneByParentId(int $parent_id) Return the first ChildCustomFieldSelectOptions filtered by the parent_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCustomFieldSelectOptions requireOneByOptionValue(string $option_value) Return the first ChildCustomFieldSelectOptions filtered by the option_value column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCustomFieldSelectOptions requireOneBySortNr(int $sort_nr) Return the first ChildCustomFieldSelectOptions filtered by the sort_nr column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildCustomFieldSelectOptions[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildCustomFieldSelectOptions objects based on current ModelCriteria
 * @method     ChildCustomFieldSelectOptions[]|ObjectCollection findById(int $id) Return ChildCustomFieldSelectOptions objects filtered by the id column
 * @method     ChildCustomFieldSelectOptions[]|ObjectCollection findByParentId(int $parent_id) Return ChildCustomFieldSelectOptions objects filtered by the parent_id column
 * @method     ChildCustomFieldSelectOptions[]|ObjectCollection findByOptionValue(string $option_value) Return ChildCustomFieldSelectOptions objects filtered by the option_value column
 * @method     ChildCustomFieldSelectOptions[]|ObjectCollection findBySortNr(int $sort_nr) Return ChildCustomFieldSelectOptions objects filtered by the sort_nr column
 * @method     ChildCustomFieldSelectOptions[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class CustomFieldSelectOptionsQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \CareMd\CareMd\Base\CustomFieldSelectOptionsQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\CareMd\\CareMd\\CustomFieldSelectOptions', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildCustomFieldSelectOptionsQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildCustomFieldSelectOptionsQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildCustomFieldSelectOptionsQuery) {
            return $criteria;
        }
        $query = new ChildCustomFieldSelectOptionsQuery();
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
     * @return ChildCustomFieldSelectOptions|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(CustomFieldSelectOptionsTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = CustomFieldSelectOptionsTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildCustomFieldSelectOptions A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, parent_id, option_value, sort_nr FROM custom_field_select_options WHERE id = :p0';
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
            /** @var ChildCustomFieldSelectOptions $obj */
            $obj = new ChildCustomFieldSelectOptions();
            $obj->hydrate($row);
            CustomFieldSelectOptionsTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildCustomFieldSelectOptions|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildCustomFieldSelectOptionsQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(CustomFieldSelectOptionsTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildCustomFieldSelectOptionsQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(CustomFieldSelectOptionsTableMap::COL_ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the id column
     *
     * Example usage:
     * <code>
     * $query->filterById(1234); // WHERE id = 1234
     * $query->filterById(array(12, 34)); // WHERE id IN (12, 34)
     * $query->filterById(array('min' => 12)); // WHERE id > 12
     * </code>
     *
     * @param     mixed $id The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCustomFieldSelectOptionsQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(CustomFieldSelectOptionsTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(CustomFieldSelectOptionsTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CustomFieldSelectOptionsTableMap::COL_ID, $id, $comparison);
    }

    /**
     * Filter the query on the parent_id column
     *
     * Example usage:
     * <code>
     * $query->filterByParentId(1234); // WHERE parent_id = 1234
     * $query->filterByParentId(array(12, 34)); // WHERE parent_id IN (12, 34)
     * $query->filterByParentId(array('min' => 12)); // WHERE parent_id > 12
     * </code>
     *
     * @param     mixed $parentId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCustomFieldSelectOptionsQuery The current query, for fluid interface
     */
    public function filterByParentId($parentId = null, $comparison = null)
    {
        if (is_array($parentId)) {
            $useMinMax = false;
            if (isset($parentId['min'])) {
                $this->addUsingAlias(CustomFieldSelectOptionsTableMap::COL_PARENT_ID, $parentId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($parentId['max'])) {
                $this->addUsingAlias(CustomFieldSelectOptionsTableMap::COL_PARENT_ID, $parentId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CustomFieldSelectOptionsTableMap::COL_PARENT_ID, $parentId, $comparison);
    }

    /**
     * Filter the query on the option_value column
     *
     * Example usage:
     * <code>
     * $query->filterByOptionValue('fooValue');   // WHERE option_value = 'fooValue'
     * $query->filterByOptionValue('%fooValue%', Criteria::LIKE); // WHERE option_value LIKE '%fooValue%'
     * </code>
     *
     * @param     string $optionValue The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCustomFieldSelectOptionsQuery The current query, for fluid interface
     */
    public function filterByOptionValue($optionValue = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($optionValue)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CustomFieldSelectOptionsTableMap::COL_OPTION_VALUE, $optionValue, $comparison);
    }

    /**
     * Filter the query on the sort_nr column
     *
     * Example usage:
     * <code>
     * $query->filterBySortNr(1234); // WHERE sort_nr = 1234
     * $query->filterBySortNr(array(12, 34)); // WHERE sort_nr IN (12, 34)
     * $query->filterBySortNr(array('min' => 12)); // WHERE sort_nr > 12
     * </code>
     *
     * @param     mixed $sortNr The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCustomFieldSelectOptionsQuery The current query, for fluid interface
     */
    public function filterBySortNr($sortNr = null, $comparison = null)
    {
        if (is_array($sortNr)) {
            $useMinMax = false;
            if (isset($sortNr['min'])) {
                $this->addUsingAlias(CustomFieldSelectOptionsTableMap::COL_SORT_NR, $sortNr['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($sortNr['max'])) {
                $this->addUsingAlias(CustomFieldSelectOptionsTableMap::COL_SORT_NR, $sortNr['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CustomFieldSelectOptionsTableMap::COL_SORT_NR, $sortNr, $comparison);
    }

    /**
     * Exclude object from result
     *
     * @param   ChildCustomFieldSelectOptions $customFieldSelectOptions Object to remove from the list of results
     *
     * @return $this|ChildCustomFieldSelectOptionsQuery The current query, for fluid interface
     */
    public function prune($customFieldSelectOptions = null)
    {
        if ($customFieldSelectOptions) {
            $this->addUsingAlias(CustomFieldSelectOptionsTableMap::COL_ID, $customFieldSelectOptions->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the custom_field_select_options table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(CustomFieldSelectOptionsTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            CustomFieldSelectOptionsTableMap::clearInstancePool();
            CustomFieldSelectOptionsTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(CustomFieldSelectOptionsTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(CustomFieldSelectOptionsTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            CustomFieldSelectOptionsTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            CustomFieldSelectOptionsTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // CustomFieldSelectOptionsQuery
