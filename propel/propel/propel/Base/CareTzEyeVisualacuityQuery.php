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
use propel\propel\CareTzEyeVisualacuity as ChildCareTzEyeVisualacuity;
use propel\propel\CareTzEyeVisualacuityQuery as ChildCareTzEyeVisualacuityQuery;
use propel\propel\Map\CareTzEyeVisualacuityTableMap;

/**
 * Base class that represents a query for the 'care_tz_eye_visualacuity' table.
 *
 *
 *
 * @method     ChildCareTzEyeVisualacuityQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildCareTzEyeVisualacuityQuery orderByPid($order = Criteria::ASC) Order by the pid column
 * @method     ChildCareTzEyeVisualacuityQuery orderByRightEyeTest1($order = Criteria::ASC) Order by the right_eye_test1 column
 * @method     ChildCareTzEyeVisualacuityQuery orderByRightEyeTest2($order = Criteria::ASC) Order by the right_eye_test2 column
 * @method     ChildCareTzEyeVisualacuityQuery orderByRightEyeTest3($order = Criteria::ASC) Order by the right_eye_test3 column
 * @method     ChildCareTzEyeVisualacuityQuery orderByLeftEyeTest1($order = Criteria::ASC) Order by the left_eye_test1 column
 * @method     ChildCareTzEyeVisualacuityQuery orderByLeftEyeTest2($order = Criteria::ASC) Order by the left_eye_test2 column
 * @method     ChildCareTzEyeVisualacuityQuery orderByLeftEyeTest3($order = Criteria::ASC) Order by the left_eye_test3 column
 * @method     ChildCareTzEyeVisualacuityQuery orderBySignature($order = Criteria::ASC) Order by the Signature column
 * @method     ChildCareTzEyeVisualacuityQuery orderByExaminationDate($order = Criteria::ASC) Order by the Examination_date column
 *
 * @method     ChildCareTzEyeVisualacuityQuery groupById() Group by the id column
 * @method     ChildCareTzEyeVisualacuityQuery groupByPid() Group by the pid column
 * @method     ChildCareTzEyeVisualacuityQuery groupByRightEyeTest1() Group by the right_eye_test1 column
 * @method     ChildCareTzEyeVisualacuityQuery groupByRightEyeTest2() Group by the right_eye_test2 column
 * @method     ChildCareTzEyeVisualacuityQuery groupByRightEyeTest3() Group by the right_eye_test3 column
 * @method     ChildCareTzEyeVisualacuityQuery groupByLeftEyeTest1() Group by the left_eye_test1 column
 * @method     ChildCareTzEyeVisualacuityQuery groupByLeftEyeTest2() Group by the left_eye_test2 column
 * @method     ChildCareTzEyeVisualacuityQuery groupByLeftEyeTest3() Group by the left_eye_test3 column
 * @method     ChildCareTzEyeVisualacuityQuery groupBySignature() Group by the Signature column
 * @method     ChildCareTzEyeVisualacuityQuery groupByExaminationDate() Group by the Examination_date column
 *
 * @method     ChildCareTzEyeVisualacuityQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildCareTzEyeVisualacuityQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildCareTzEyeVisualacuityQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildCareTzEyeVisualacuityQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildCareTzEyeVisualacuityQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildCareTzEyeVisualacuityQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildCareTzEyeVisualacuity findOne(ConnectionInterface $con = null) Return the first ChildCareTzEyeVisualacuity matching the query
 * @method     ChildCareTzEyeVisualacuity findOneOrCreate(ConnectionInterface $con = null) Return the first ChildCareTzEyeVisualacuity matching the query, or a new ChildCareTzEyeVisualacuity object populated from the query conditions when no match is found
 *
 * @method     ChildCareTzEyeVisualacuity findOneById(int $id) Return the first ChildCareTzEyeVisualacuity filtered by the id column
 * @method     ChildCareTzEyeVisualacuity findOneByPid(int $pid) Return the first ChildCareTzEyeVisualacuity filtered by the pid column
 * @method     ChildCareTzEyeVisualacuity findOneByRightEyeTest1(string $right_eye_test1) Return the first ChildCareTzEyeVisualacuity filtered by the right_eye_test1 column
 * @method     ChildCareTzEyeVisualacuity findOneByRightEyeTest2(string $right_eye_test2) Return the first ChildCareTzEyeVisualacuity filtered by the right_eye_test2 column
 * @method     ChildCareTzEyeVisualacuity findOneByRightEyeTest3(string $right_eye_test3) Return the first ChildCareTzEyeVisualacuity filtered by the right_eye_test3 column
 * @method     ChildCareTzEyeVisualacuity findOneByLeftEyeTest1(string $left_eye_test1) Return the first ChildCareTzEyeVisualacuity filtered by the left_eye_test1 column
 * @method     ChildCareTzEyeVisualacuity findOneByLeftEyeTest2(string $left_eye_test2) Return the first ChildCareTzEyeVisualacuity filtered by the left_eye_test2 column
 * @method     ChildCareTzEyeVisualacuity findOneByLeftEyeTest3(string $left_eye_test3) Return the first ChildCareTzEyeVisualacuity filtered by the left_eye_test3 column
 * @method     ChildCareTzEyeVisualacuity findOneBySignature(string $Signature) Return the first ChildCareTzEyeVisualacuity filtered by the Signature column
 * @method     ChildCareTzEyeVisualacuity findOneByExaminationDate(string $Examination_date) Return the first ChildCareTzEyeVisualacuity filtered by the Examination_date column *

 * @method     ChildCareTzEyeVisualacuity requirePk($key, ConnectionInterface $con = null) Return the ChildCareTzEyeVisualacuity by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCareTzEyeVisualacuity requireOne(ConnectionInterface $con = null) Return the first ChildCareTzEyeVisualacuity matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildCareTzEyeVisualacuity requireOneById(int $id) Return the first ChildCareTzEyeVisualacuity filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCareTzEyeVisualacuity requireOneByPid(int $pid) Return the first ChildCareTzEyeVisualacuity filtered by the pid column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCareTzEyeVisualacuity requireOneByRightEyeTest1(string $right_eye_test1) Return the first ChildCareTzEyeVisualacuity filtered by the right_eye_test1 column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCareTzEyeVisualacuity requireOneByRightEyeTest2(string $right_eye_test2) Return the first ChildCareTzEyeVisualacuity filtered by the right_eye_test2 column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCareTzEyeVisualacuity requireOneByRightEyeTest3(string $right_eye_test3) Return the first ChildCareTzEyeVisualacuity filtered by the right_eye_test3 column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCareTzEyeVisualacuity requireOneByLeftEyeTest1(string $left_eye_test1) Return the first ChildCareTzEyeVisualacuity filtered by the left_eye_test1 column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCareTzEyeVisualacuity requireOneByLeftEyeTest2(string $left_eye_test2) Return the first ChildCareTzEyeVisualacuity filtered by the left_eye_test2 column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCareTzEyeVisualacuity requireOneByLeftEyeTest3(string $left_eye_test3) Return the first ChildCareTzEyeVisualacuity filtered by the left_eye_test3 column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCareTzEyeVisualacuity requireOneBySignature(string $Signature) Return the first ChildCareTzEyeVisualacuity filtered by the Signature column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCareTzEyeVisualacuity requireOneByExaminationDate(string $Examination_date) Return the first ChildCareTzEyeVisualacuity filtered by the Examination_date column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildCareTzEyeVisualacuity[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildCareTzEyeVisualacuity objects based on current ModelCriteria
 * @method     ChildCareTzEyeVisualacuity[]|ObjectCollection findById(int $id) Return ChildCareTzEyeVisualacuity objects filtered by the id column
 * @method     ChildCareTzEyeVisualacuity[]|ObjectCollection findByPid(int $pid) Return ChildCareTzEyeVisualacuity objects filtered by the pid column
 * @method     ChildCareTzEyeVisualacuity[]|ObjectCollection findByRightEyeTest1(string $right_eye_test1) Return ChildCareTzEyeVisualacuity objects filtered by the right_eye_test1 column
 * @method     ChildCareTzEyeVisualacuity[]|ObjectCollection findByRightEyeTest2(string $right_eye_test2) Return ChildCareTzEyeVisualacuity objects filtered by the right_eye_test2 column
 * @method     ChildCareTzEyeVisualacuity[]|ObjectCollection findByRightEyeTest3(string $right_eye_test3) Return ChildCareTzEyeVisualacuity objects filtered by the right_eye_test3 column
 * @method     ChildCareTzEyeVisualacuity[]|ObjectCollection findByLeftEyeTest1(string $left_eye_test1) Return ChildCareTzEyeVisualacuity objects filtered by the left_eye_test1 column
 * @method     ChildCareTzEyeVisualacuity[]|ObjectCollection findByLeftEyeTest2(string $left_eye_test2) Return ChildCareTzEyeVisualacuity objects filtered by the left_eye_test2 column
 * @method     ChildCareTzEyeVisualacuity[]|ObjectCollection findByLeftEyeTest3(string $left_eye_test3) Return ChildCareTzEyeVisualacuity objects filtered by the left_eye_test3 column
 * @method     ChildCareTzEyeVisualacuity[]|ObjectCollection findBySignature(string $Signature) Return ChildCareTzEyeVisualacuity objects filtered by the Signature column
 * @method     ChildCareTzEyeVisualacuity[]|ObjectCollection findByExaminationDate(string $Examination_date) Return ChildCareTzEyeVisualacuity objects filtered by the Examination_date column
 * @method     ChildCareTzEyeVisualacuity[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class CareTzEyeVisualacuityQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \propel\propel\Base\CareTzEyeVisualacuityQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\propel\\propel\\CareTzEyeVisualacuity', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildCareTzEyeVisualacuityQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildCareTzEyeVisualacuityQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildCareTzEyeVisualacuityQuery) {
            return $criteria;
        }
        $query = new ChildCareTzEyeVisualacuityQuery();
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
     * @return ChildCareTzEyeVisualacuity|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(CareTzEyeVisualacuityTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = CareTzEyeVisualacuityTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildCareTzEyeVisualacuity A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, pid, right_eye_test1, right_eye_test2, right_eye_test3, left_eye_test1, left_eye_test2, left_eye_test3, Signature, Examination_date FROM care_tz_eye_visualacuity WHERE id = :p0';
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
            /** @var ChildCareTzEyeVisualacuity $obj */
            $obj = new ChildCareTzEyeVisualacuity();
            $obj->hydrate($row);
            CareTzEyeVisualacuityTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildCareTzEyeVisualacuity|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildCareTzEyeVisualacuityQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(CareTzEyeVisualacuityTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildCareTzEyeVisualacuityQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(CareTzEyeVisualacuityTableMap::COL_ID, $keys, Criteria::IN);
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
     * @return $this|ChildCareTzEyeVisualacuityQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(CareTzEyeVisualacuityTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(CareTzEyeVisualacuityTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CareTzEyeVisualacuityTableMap::COL_ID, $id, $comparison);
    }

    /**
     * Filter the query on the pid column
     *
     * Example usage:
     * <code>
     * $query->filterByPid(1234); // WHERE pid = 1234
     * $query->filterByPid(array(12, 34)); // WHERE pid IN (12, 34)
     * $query->filterByPid(array('min' => 12)); // WHERE pid > 12
     * </code>
     *
     * @param     mixed $pid The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCareTzEyeVisualacuityQuery The current query, for fluid interface
     */
    public function filterByPid($pid = null, $comparison = null)
    {
        if (is_array($pid)) {
            $useMinMax = false;
            if (isset($pid['min'])) {
                $this->addUsingAlias(CareTzEyeVisualacuityTableMap::COL_PID, $pid['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($pid['max'])) {
                $this->addUsingAlias(CareTzEyeVisualacuityTableMap::COL_PID, $pid['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CareTzEyeVisualacuityTableMap::COL_PID, $pid, $comparison);
    }

    /**
     * Filter the query on the right_eye_test1 column
     *
     * Example usage:
     * <code>
     * $query->filterByRightEyeTest1('fooValue');   // WHERE right_eye_test1 = 'fooValue'
     * $query->filterByRightEyeTest1('%fooValue%', Criteria::LIKE); // WHERE right_eye_test1 LIKE '%fooValue%'
     * </code>
     *
     * @param     string $rightEyeTest1 The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCareTzEyeVisualacuityQuery The current query, for fluid interface
     */
    public function filterByRightEyeTest1($rightEyeTest1 = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($rightEyeTest1)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CareTzEyeVisualacuityTableMap::COL_RIGHT_EYE_TEST1, $rightEyeTest1, $comparison);
    }

    /**
     * Filter the query on the right_eye_test2 column
     *
     * Example usage:
     * <code>
     * $query->filterByRightEyeTest2('fooValue');   // WHERE right_eye_test2 = 'fooValue'
     * $query->filterByRightEyeTest2('%fooValue%', Criteria::LIKE); // WHERE right_eye_test2 LIKE '%fooValue%'
     * </code>
     *
     * @param     string $rightEyeTest2 The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCareTzEyeVisualacuityQuery The current query, for fluid interface
     */
    public function filterByRightEyeTest2($rightEyeTest2 = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($rightEyeTest2)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CareTzEyeVisualacuityTableMap::COL_RIGHT_EYE_TEST2, $rightEyeTest2, $comparison);
    }

    /**
     * Filter the query on the right_eye_test3 column
     *
     * Example usage:
     * <code>
     * $query->filterByRightEyeTest3('fooValue');   // WHERE right_eye_test3 = 'fooValue'
     * $query->filterByRightEyeTest3('%fooValue%', Criteria::LIKE); // WHERE right_eye_test3 LIKE '%fooValue%'
     * </code>
     *
     * @param     string $rightEyeTest3 The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCareTzEyeVisualacuityQuery The current query, for fluid interface
     */
    public function filterByRightEyeTest3($rightEyeTest3 = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($rightEyeTest3)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CareTzEyeVisualacuityTableMap::COL_RIGHT_EYE_TEST3, $rightEyeTest3, $comparison);
    }

    /**
     * Filter the query on the left_eye_test1 column
     *
     * Example usage:
     * <code>
     * $query->filterByLeftEyeTest1('fooValue');   // WHERE left_eye_test1 = 'fooValue'
     * $query->filterByLeftEyeTest1('%fooValue%', Criteria::LIKE); // WHERE left_eye_test1 LIKE '%fooValue%'
     * </code>
     *
     * @param     string $leftEyeTest1 The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCareTzEyeVisualacuityQuery The current query, for fluid interface
     */
    public function filterByLeftEyeTest1($leftEyeTest1 = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($leftEyeTest1)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CareTzEyeVisualacuityTableMap::COL_LEFT_EYE_TEST1, $leftEyeTest1, $comparison);
    }

    /**
     * Filter the query on the left_eye_test2 column
     *
     * Example usage:
     * <code>
     * $query->filterByLeftEyeTest2('fooValue');   // WHERE left_eye_test2 = 'fooValue'
     * $query->filterByLeftEyeTest2('%fooValue%', Criteria::LIKE); // WHERE left_eye_test2 LIKE '%fooValue%'
     * </code>
     *
     * @param     string $leftEyeTest2 The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCareTzEyeVisualacuityQuery The current query, for fluid interface
     */
    public function filterByLeftEyeTest2($leftEyeTest2 = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($leftEyeTest2)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CareTzEyeVisualacuityTableMap::COL_LEFT_EYE_TEST2, $leftEyeTest2, $comparison);
    }

    /**
     * Filter the query on the left_eye_test3 column
     *
     * Example usage:
     * <code>
     * $query->filterByLeftEyeTest3('fooValue');   // WHERE left_eye_test3 = 'fooValue'
     * $query->filterByLeftEyeTest3('%fooValue%', Criteria::LIKE); // WHERE left_eye_test3 LIKE '%fooValue%'
     * </code>
     *
     * @param     string $leftEyeTest3 The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCareTzEyeVisualacuityQuery The current query, for fluid interface
     */
    public function filterByLeftEyeTest3($leftEyeTest3 = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($leftEyeTest3)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CareTzEyeVisualacuityTableMap::COL_LEFT_EYE_TEST3, $leftEyeTest3, $comparison);
    }

    /**
     * Filter the query on the Signature column
     *
     * Example usage:
     * <code>
     * $query->filterBySignature('fooValue');   // WHERE Signature = 'fooValue'
     * $query->filterBySignature('%fooValue%', Criteria::LIKE); // WHERE Signature LIKE '%fooValue%'
     * </code>
     *
     * @param     string $signature The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCareTzEyeVisualacuityQuery The current query, for fluid interface
     */
    public function filterBySignature($signature = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($signature)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CareTzEyeVisualacuityTableMap::COL_SIGNATURE, $signature, $comparison);
    }

    /**
     * Filter the query on the Examination_date column
     *
     * Example usage:
     * <code>
     * $query->filterByExaminationDate('2011-03-14'); // WHERE Examination_date = '2011-03-14'
     * $query->filterByExaminationDate('now'); // WHERE Examination_date = '2011-03-14'
     * $query->filterByExaminationDate(array('max' => 'yesterday')); // WHERE Examination_date > '2011-03-13'
     * </code>
     *
     * @param     mixed $examinationDate The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCareTzEyeVisualacuityQuery The current query, for fluid interface
     */
    public function filterByExaminationDate($examinationDate = null, $comparison = null)
    {
        if (is_array($examinationDate)) {
            $useMinMax = false;
            if (isset($examinationDate['min'])) {
                $this->addUsingAlias(CareTzEyeVisualacuityTableMap::COL_EXAMINATION_DATE, $examinationDate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($examinationDate['max'])) {
                $this->addUsingAlias(CareTzEyeVisualacuityTableMap::COL_EXAMINATION_DATE, $examinationDate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CareTzEyeVisualacuityTableMap::COL_EXAMINATION_DATE, $examinationDate, $comparison);
    }

    /**
     * Exclude object from result
     *
     * @param   ChildCareTzEyeVisualacuity $careTzEyeVisualacuity Object to remove from the list of results
     *
     * @return $this|ChildCareTzEyeVisualacuityQuery The current query, for fluid interface
     */
    public function prune($careTzEyeVisualacuity = null)
    {
        if ($careTzEyeVisualacuity) {
            $this->addUsingAlias(CareTzEyeVisualacuityTableMap::COL_ID, $careTzEyeVisualacuity->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the care_tz_eye_visualacuity table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(CareTzEyeVisualacuityTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            CareTzEyeVisualacuityTableMap::clearInstancePool();
            CareTzEyeVisualacuityTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(CareTzEyeVisualacuityTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(CareTzEyeVisualacuityTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            CareTzEyeVisualacuityTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            CareTzEyeVisualacuityTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // CareTzEyeVisualacuityQuery
