<?php

namespace CareMd\CareMd\Base;

use \Exception;
use \PDO;
use CareMd\CareMd\CareTestFindingsRadio as ChildCareTestFindingsRadio;
use CareMd\CareMd\CareTestFindingsRadioQuery as ChildCareTestFindingsRadioQuery;
use CareMd\CareMd\Map\CareTestFindingsRadioTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'care_test_findings_radio' table.
 *
 *
 *
 * @method     ChildCareTestFindingsRadioQuery orderByBatchNr($order = Criteria::ASC) Order by the batch_nr column
 * @method     ChildCareTestFindingsRadioQuery orderByEncounterNr($order = Criteria::ASC) Order by the encounter_nr column
 * @method     ChildCareTestFindingsRadioQuery orderByRoomNr($order = Criteria::ASC) Order by the room_nr column
 * @method     ChildCareTestFindingsRadioQuery orderByDeptNr($order = Criteria::ASC) Order by the dept_nr column
 * @method     ChildCareTestFindingsRadioQuery orderByFindings($order = Criteria::ASC) Order by the findings column
 * @method     ChildCareTestFindingsRadioQuery orderByDiagnosis($order = Criteria::ASC) Order by the diagnosis column
 * @method     ChildCareTestFindingsRadioQuery orderByDoctorId($order = Criteria::ASC) Order by the doctor_id column
 * @method     ChildCareTestFindingsRadioQuery orderByFindingsDate($order = Criteria::ASC) Order by the findings_date column
 * @method     ChildCareTestFindingsRadioQuery orderByFindingsTime($order = Criteria::ASC) Order by the findings_time column
 * @method     ChildCareTestFindingsRadioQuery orderByStatus($order = Criteria::ASC) Order by the status column
 * @method     ChildCareTestFindingsRadioQuery orderByHistory($order = Criteria::ASC) Order by the history column
 * @method     ChildCareTestFindingsRadioQuery orderByModifyId($order = Criteria::ASC) Order by the modify_id column
 * @method     ChildCareTestFindingsRadioQuery orderByModifyTime($order = Criteria::ASC) Order by the modify_time column
 * @method     ChildCareTestFindingsRadioQuery orderByCreateId($order = Criteria::ASC) Order by the create_id column
 * @method     ChildCareTestFindingsRadioQuery orderByCreateTime($order = Criteria::ASC) Order by the create_time column
 *
 * @method     ChildCareTestFindingsRadioQuery groupByBatchNr() Group by the batch_nr column
 * @method     ChildCareTestFindingsRadioQuery groupByEncounterNr() Group by the encounter_nr column
 * @method     ChildCareTestFindingsRadioQuery groupByRoomNr() Group by the room_nr column
 * @method     ChildCareTestFindingsRadioQuery groupByDeptNr() Group by the dept_nr column
 * @method     ChildCareTestFindingsRadioQuery groupByFindings() Group by the findings column
 * @method     ChildCareTestFindingsRadioQuery groupByDiagnosis() Group by the diagnosis column
 * @method     ChildCareTestFindingsRadioQuery groupByDoctorId() Group by the doctor_id column
 * @method     ChildCareTestFindingsRadioQuery groupByFindingsDate() Group by the findings_date column
 * @method     ChildCareTestFindingsRadioQuery groupByFindingsTime() Group by the findings_time column
 * @method     ChildCareTestFindingsRadioQuery groupByStatus() Group by the status column
 * @method     ChildCareTestFindingsRadioQuery groupByHistory() Group by the history column
 * @method     ChildCareTestFindingsRadioQuery groupByModifyId() Group by the modify_id column
 * @method     ChildCareTestFindingsRadioQuery groupByModifyTime() Group by the modify_time column
 * @method     ChildCareTestFindingsRadioQuery groupByCreateId() Group by the create_id column
 * @method     ChildCareTestFindingsRadioQuery groupByCreateTime() Group by the create_time column
 *
 * @method     ChildCareTestFindingsRadioQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildCareTestFindingsRadioQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildCareTestFindingsRadioQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildCareTestFindingsRadioQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildCareTestFindingsRadioQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildCareTestFindingsRadioQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildCareTestFindingsRadio findOne(ConnectionInterface $con = null) Return the first ChildCareTestFindingsRadio matching the query
 * @method     ChildCareTestFindingsRadio findOneOrCreate(ConnectionInterface $con = null) Return the first ChildCareTestFindingsRadio matching the query, or a new ChildCareTestFindingsRadio object populated from the query conditions when no match is found
 *
 * @method     ChildCareTestFindingsRadio findOneByBatchNr(int $batch_nr) Return the first ChildCareTestFindingsRadio filtered by the batch_nr column
 * @method     ChildCareTestFindingsRadio findOneByEncounterNr(int $encounter_nr) Return the first ChildCareTestFindingsRadio filtered by the encounter_nr column
 * @method     ChildCareTestFindingsRadio findOneByRoomNr(int $room_nr) Return the first ChildCareTestFindingsRadio filtered by the room_nr column
 * @method     ChildCareTestFindingsRadio findOneByDeptNr(int $dept_nr) Return the first ChildCareTestFindingsRadio filtered by the dept_nr column
 * @method     ChildCareTestFindingsRadio findOneByFindings(string $findings) Return the first ChildCareTestFindingsRadio filtered by the findings column
 * @method     ChildCareTestFindingsRadio findOneByDiagnosis(string $diagnosis) Return the first ChildCareTestFindingsRadio filtered by the diagnosis column
 * @method     ChildCareTestFindingsRadio findOneByDoctorId(string $doctor_id) Return the first ChildCareTestFindingsRadio filtered by the doctor_id column
 * @method     ChildCareTestFindingsRadio findOneByFindingsDate(string $findings_date) Return the first ChildCareTestFindingsRadio filtered by the findings_date column
 * @method     ChildCareTestFindingsRadio findOneByFindingsTime(string $findings_time) Return the first ChildCareTestFindingsRadio filtered by the findings_time column
 * @method     ChildCareTestFindingsRadio findOneByStatus(string $status) Return the first ChildCareTestFindingsRadio filtered by the status column
 * @method     ChildCareTestFindingsRadio findOneByHistory(string $history) Return the first ChildCareTestFindingsRadio filtered by the history column
 * @method     ChildCareTestFindingsRadio findOneByModifyId(string $modify_id) Return the first ChildCareTestFindingsRadio filtered by the modify_id column
 * @method     ChildCareTestFindingsRadio findOneByModifyTime(string $modify_time) Return the first ChildCareTestFindingsRadio filtered by the modify_time column
 * @method     ChildCareTestFindingsRadio findOneByCreateId(string $create_id) Return the first ChildCareTestFindingsRadio filtered by the create_id column
 * @method     ChildCareTestFindingsRadio findOneByCreateTime(string $create_time) Return the first ChildCareTestFindingsRadio filtered by the create_time column *

 * @method     ChildCareTestFindingsRadio requirePk($key, ConnectionInterface $con = null) Return the ChildCareTestFindingsRadio by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCareTestFindingsRadio requireOne(ConnectionInterface $con = null) Return the first ChildCareTestFindingsRadio matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildCareTestFindingsRadio requireOneByBatchNr(int $batch_nr) Return the first ChildCareTestFindingsRadio filtered by the batch_nr column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCareTestFindingsRadio requireOneByEncounterNr(int $encounter_nr) Return the first ChildCareTestFindingsRadio filtered by the encounter_nr column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCareTestFindingsRadio requireOneByRoomNr(int $room_nr) Return the first ChildCareTestFindingsRadio filtered by the room_nr column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCareTestFindingsRadio requireOneByDeptNr(int $dept_nr) Return the first ChildCareTestFindingsRadio filtered by the dept_nr column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCareTestFindingsRadio requireOneByFindings(string $findings) Return the first ChildCareTestFindingsRadio filtered by the findings column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCareTestFindingsRadio requireOneByDiagnosis(string $diagnosis) Return the first ChildCareTestFindingsRadio filtered by the diagnosis column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCareTestFindingsRadio requireOneByDoctorId(string $doctor_id) Return the first ChildCareTestFindingsRadio filtered by the doctor_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCareTestFindingsRadio requireOneByFindingsDate(string $findings_date) Return the first ChildCareTestFindingsRadio filtered by the findings_date column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCareTestFindingsRadio requireOneByFindingsTime(string $findings_time) Return the first ChildCareTestFindingsRadio filtered by the findings_time column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCareTestFindingsRadio requireOneByStatus(string $status) Return the first ChildCareTestFindingsRadio filtered by the status column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCareTestFindingsRadio requireOneByHistory(string $history) Return the first ChildCareTestFindingsRadio filtered by the history column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCareTestFindingsRadio requireOneByModifyId(string $modify_id) Return the first ChildCareTestFindingsRadio filtered by the modify_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCareTestFindingsRadio requireOneByModifyTime(string $modify_time) Return the first ChildCareTestFindingsRadio filtered by the modify_time column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCareTestFindingsRadio requireOneByCreateId(string $create_id) Return the first ChildCareTestFindingsRadio filtered by the create_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCareTestFindingsRadio requireOneByCreateTime(string $create_time) Return the first ChildCareTestFindingsRadio filtered by the create_time column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildCareTestFindingsRadio[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildCareTestFindingsRadio objects based on current ModelCriteria
 * @method     ChildCareTestFindingsRadio[]|ObjectCollection findByBatchNr(int $batch_nr) Return ChildCareTestFindingsRadio objects filtered by the batch_nr column
 * @method     ChildCareTestFindingsRadio[]|ObjectCollection findByEncounterNr(int $encounter_nr) Return ChildCareTestFindingsRadio objects filtered by the encounter_nr column
 * @method     ChildCareTestFindingsRadio[]|ObjectCollection findByRoomNr(int $room_nr) Return ChildCareTestFindingsRadio objects filtered by the room_nr column
 * @method     ChildCareTestFindingsRadio[]|ObjectCollection findByDeptNr(int $dept_nr) Return ChildCareTestFindingsRadio objects filtered by the dept_nr column
 * @method     ChildCareTestFindingsRadio[]|ObjectCollection findByFindings(string $findings) Return ChildCareTestFindingsRadio objects filtered by the findings column
 * @method     ChildCareTestFindingsRadio[]|ObjectCollection findByDiagnosis(string $diagnosis) Return ChildCareTestFindingsRadio objects filtered by the diagnosis column
 * @method     ChildCareTestFindingsRadio[]|ObjectCollection findByDoctorId(string $doctor_id) Return ChildCareTestFindingsRadio objects filtered by the doctor_id column
 * @method     ChildCareTestFindingsRadio[]|ObjectCollection findByFindingsDate(string $findings_date) Return ChildCareTestFindingsRadio objects filtered by the findings_date column
 * @method     ChildCareTestFindingsRadio[]|ObjectCollection findByFindingsTime(string $findings_time) Return ChildCareTestFindingsRadio objects filtered by the findings_time column
 * @method     ChildCareTestFindingsRadio[]|ObjectCollection findByStatus(string $status) Return ChildCareTestFindingsRadio objects filtered by the status column
 * @method     ChildCareTestFindingsRadio[]|ObjectCollection findByHistory(string $history) Return ChildCareTestFindingsRadio objects filtered by the history column
 * @method     ChildCareTestFindingsRadio[]|ObjectCollection findByModifyId(string $modify_id) Return ChildCareTestFindingsRadio objects filtered by the modify_id column
 * @method     ChildCareTestFindingsRadio[]|ObjectCollection findByModifyTime(string $modify_time) Return ChildCareTestFindingsRadio objects filtered by the modify_time column
 * @method     ChildCareTestFindingsRadio[]|ObjectCollection findByCreateId(string $create_id) Return ChildCareTestFindingsRadio objects filtered by the create_id column
 * @method     ChildCareTestFindingsRadio[]|ObjectCollection findByCreateTime(string $create_time) Return ChildCareTestFindingsRadio objects filtered by the create_time column
 * @method     ChildCareTestFindingsRadio[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class CareTestFindingsRadioQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \CareMd\CareMd\Base\CareTestFindingsRadioQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\CareMd\\CareMd\\CareTestFindingsRadio', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildCareTestFindingsRadioQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildCareTestFindingsRadioQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildCareTestFindingsRadioQuery) {
            return $criteria;
        }
        $query = new ChildCareTestFindingsRadioQuery();
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
     * $obj = $c->findPk(array(12, 34), $con);
     * </code>
     *
     * @param array[$batch_nr, $encounter_nr] $key Primary key to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return ChildCareTestFindingsRadio|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(CareTestFindingsRadioTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = CareTestFindingsRadioTableMap::getInstanceFromPool(serialize([(null === $key[0] || is_scalar($key[0]) || is_callable([$key[0], '__toString']) ? (string) $key[0] : $key[0]), (null === $key[1] || is_scalar($key[1]) || is_callable([$key[1], '__toString']) ? (string) $key[1] : $key[1])]))))) {
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
     * @return ChildCareTestFindingsRadio A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT batch_nr, encounter_nr, room_nr, dept_nr, findings, diagnosis, doctor_id, findings_date, findings_time, status, history, modify_id, modify_time, create_id, create_time FROM care_test_findings_radio WHERE batch_nr = :p0 AND encounter_nr = :p1';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key[0], PDO::PARAM_INT);
            $stmt->bindValue(':p1', $key[1], PDO::PARAM_INT);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), 0, $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(\PDO::FETCH_NUM)) {
            /** @var ChildCareTestFindingsRadio $obj */
            $obj = new ChildCareTestFindingsRadio();
            $obj->hydrate($row);
            CareTestFindingsRadioTableMap::addInstanceToPool($obj, serialize([(null === $key[0] || is_scalar($key[0]) || is_callable([$key[0], '__toString']) ? (string) $key[0] : $key[0]), (null === $key[1] || is_scalar($key[1]) || is_callable([$key[1], '__toString']) ? (string) $key[1] : $key[1])]));
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
     * @return ChildCareTestFindingsRadio|array|mixed the result, formatted by the current formatter
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
     * $objs = $c->findPks(array(array(12, 56), array(832, 123), array(123, 456)), $con);
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
     * @return $this|ChildCareTestFindingsRadioQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {
        $this->addUsingAlias(CareTestFindingsRadioTableMap::COL_BATCH_NR, $key[0], Criteria::EQUAL);
        $this->addUsingAlias(CareTestFindingsRadioTableMap::COL_ENCOUNTER_NR, $key[1], Criteria::EQUAL);

        return $this;
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildCareTestFindingsRadioQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {
        if (empty($keys)) {
            return $this->add(null, '1<>1', Criteria::CUSTOM);
        }
        foreach ($keys as $key) {
            $cton0 = $this->getNewCriterion(CareTestFindingsRadioTableMap::COL_BATCH_NR, $key[0], Criteria::EQUAL);
            $cton1 = $this->getNewCriterion(CareTestFindingsRadioTableMap::COL_ENCOUNTER_NR, $key[1], Criteria::EQUAL);
            $cton0->addAnd($cton1);
            $this->addOr($cton0);
        }

        return $this;
    }

    /**
     * Filter the query on the batch_nr column
     *
     * Example usage:
     * <code>
     * $query->filterByBatchNr(1234); // WHERE batch_nr = 1234
     * $query->filterByBatchNr(array(12, 34)); // WHERE batch_nr IN (12, 34)
     * $query->filterByBatchNr(array('min' => 12)); // WHERE batch_nr > 12
     * </code>
     *
     * @param     mixed $batchNr The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCareTestFindingsRadioQuery The current query, for fluid interface
     */
    public function filterByBatchNr($batchNr = null, $comparison = null)
    {
        if (is_array($batchNr)) {
            $useMinMax = false;
            if (isset($batchNr['min'])) {
                $this->addUsingAlias(CareTestFindingsRadioTableMap::COL_BATCH_NR, $batchNr['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($batchNr['max'])) {
                $this->addUsingAlias(CareTestFindingsRadioTableMap::COL_BATCH_NR, $batchNr['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CareTestFindingsRadioTableMap::COL_BATCH_NR, $batchNr, $comparison);
    }

    /**
     * Filter the query on the encounter_nr column
     *
     * Example usage:
     * <code>
     * $query->filterByEncounterNr(1234); // WHERE encounter_nr = 1234
     * $query->filterByEncounterNr(array(12, 34)); // WHERE encounter_nr IN (12, 34)
     * $query->filterByEncounterNr(array('min' => 12)); // WHERE encounter_nr > 12
     * </code>
     *
     * @param     mixed $encounterNr The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCareTestFindingsRadioQuery The current query, for fluid interface
     */
    public function filterByEncounterNr($encounterNr = null, $comparison = null)
    {
        if (is_array($encounterNr)) {
            $useMinMax = false;
            if (isset($encounterNr['min'])) {
                $this->addUsingAlias(CareTestFindingsRadioTableMap::COL_ENCOUNTER_NR, $encounterNr['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($encounterNr['max'])) {
                $this->addUsingAlias(CareTestFindingsRadioTableMap::COL_ENCOUNTER_NR, $encounterNr['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CareTestFindingsRadioTableMap::COL_ENCOUNTER_NR, $encounterNr, $comparison);
    }

    /**
     * Filter the query on the room_nr column
     *
     * Example usage:
     * <code>
     * $query->filterByRoomNr(1234); // WHERE room_nr = 1234
     * $query->filterByRoomNr(array(12, 34)); // WHERE room_nr IN (12, 34)
     * $query->filterByRoomNr(array('min' => 12)); // WHERE room_nr > 12
     * </code>
     *
     * @param     mixed $roomNr The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCareTestFindingsRadioQuery The current query, for fluid interface
     */
    public function filterByRoomNr($roomNr = null, $comparison = null)
    {
        if (is_array($roomNr)) {
            $useMinMax = false;
            if (isset($roomNr['min'])) {
                $this->addUsingAlias(CareTestFindingsRadioTableMap::COL_ROOM_NR, $roomNr['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($roomNr['max'])) {
                $this->addUsingAlias(CareTestFindingsRadioTableMap::COL_ROOM_NR, $roomNr['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CareTestFindingsRadioTableMap::COL_ROOM_NR, $roomNr, $comparison);
    }

    /**
     * Filter the query on the dept_nr column
     *
     * Example usage:
     * <code>
     * $query->filterByDeptNr(1234); // WHERE dept_nr = 1234
     * $query->filterByDeptNr(array(12, 34)); // WHERE dept_nr IN (12, 34)
     * $query->filterByDeptNr(array('min' => 12)); // WHERE dept_nr > 12
     * </code>
     *
     * @param     mixed $deptNr The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCareTestFindingsRadioQuery The current query, for fluid interface
     */
    public function filterByDeptNr($deptNr = null, $comparison = null)
    {
        if (is_array($deptNr)) {
            $useMinMax = false;
            if (isset($deptNr['min'])) {
                $this->addUsingAlias(CareTestFindingsRadioTableMap::COL_DEPT_NR, $deptNr['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($deptNr['max'])) {
                $this->addUsingAlias(CareTestFindingsRadioTableMap::COL_DEPT_NR, $deptNr['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CareTestFindingsRadioTableMap::COL_DEPT_NR, $deptNr, $comparison);
    }

    /**
     * Filter the query on the findings column
     *
     * Example usage:
     * <code>
     * $query->filterByFindings('fooValue');   // WHERE findings = 'fooValue'
     * $query->filterByFindings('%fooValue%', Criteria::LIKE); // WHERE findings LIKE '%fooValue%'
     * </code>
     *
     * @param     string $findings The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCareTestFindingsRadioQuery The current query, for fluid interface
     */
    public function filterByFindings($findings = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($findings)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CareTestFindingsRadioTableMap::COL_FINDINGS, $findings, $comparison);
    }

    /**
     * Filter the query on the diagnosis column
     *
     * Example usage:
     * <code>
     * $query->filterByDiagnosis('fooValue');   // WHERE diagnosis = 'fooValue'
     * $query->filterByDiagnosis('%fooValue%', Criteria::LIKE); // WHERE diagnosis LIKE '%fooValue%'
     * </code>
     *
     * @param     string $diagnosis The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCareTestFindingsRadioQuery The current query, for fluid interface
     */
    public function filterByDiagnosis($diagnosis = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($diagnosis)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CareTestFindingsRadioTableMap::COL_DIAGNOSIS, $diagnosis, $comparison);
    }

    /**
     * Filter the query on the doctor_id column
     *
     * Example usage:
     * <code>
     * $query->filterByDoctorId('fooValue');   // WHERE doctor_id = 'fooValue'
     * $query->filterByDoctorId('%fooValue%', Criteria::LIKE); // WHERE doctor_id LIKE '%fooValue%'
     * </code>
     *
     * @param     string $doctorId The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCareTestFindingsRadioQuery The current query, for fluid interface
     */
    public function filterByDoctorId($doctorId = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($doctorId)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CareTestFindingsRadioTableMap::COL_DOCTOR_ID, $doctorId, $comparison);
    }

    /**
     * Filter the query on the findings_date column
     *
     * Example usage:
     * <code>
     * $query->filterByFindingsDate('2011-03-14'); // WHERE findings_date = '2011-03-14'
     * $query->filterByFindingsDate('now'); // WHERE findings_date = '2011-03-14'
     * $query->filterByFindingsDate(array('max' => 'yesterday')); // WHERE findings_date > '2011-03-13'
     * </code>
     *
     * @param     mixed $findingsDate The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCareTestFindingsRadioQuery The current query, for fluid interface
     */
    public function filterByFindingsDate($findingsDate = null, $comparison = null)
    {
        if (is_array($findingsDate)) {
            $useMinMax = false;
            if (isset($findingsDate['min'])) {
                $this->addUsingAlias(CareTestFindingsRadioTableMap::COL_FINDINGS_DATE, $findingsDate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($findingsDate['max'])) {
                $this->addUsingAlias(CareTestFindingsRadioTableMap::COL_FINDINGS_DATE, $findingsDate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CareTestFindingsRadioTableMap::COL_FINDINGS_DATE, $findingsDate, $comparison);
    }

    /**
     * Filter the query on the findings_time column
     *
     * Example usage:
     * <code>
     * $query->filterByFindingsTime('2011-03-14'); // WHERE findings_time = '2011-03-14'
     * $query->filterByFindingsTime('now'); // WHERE findings_time = '2011-03-14'
     * $query->filterByFindingsTime(array('max' => 'yesterday')); // WHERE findings_time > '2011-03-13'
     * </code>
     *
     * @param     mixed $findingsTime The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCareTestFindingsRadioQuery The current query, for fluid interface
     */
    public function filterByFindingsTime($findingsTime = null, $comparison = null)
    {
        if (is_array($findingsTime)) {
            $useMinMax = false;
            if (isset($findingsTime['min'])) {
                $this->addUsingAlias(CareTestFindingsRadioTableMap::COL_FINDINGS_TIME, $findingsTime['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($findingsTime['max'])) {
                $this->addUsingAlias(CareTestFindingsRadioTableMap::COL_FINDINGS_TIME, $findingsTime['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CareTestFindingsRadioTableMap::COL_FINDINGS_TIME, $findingsTime, $comparison);
    }

    /**
     * Filter the query on the status column
     *
     * Example usage:
     * <code>
     * $query->filterByStatus('fooValue');   // WHERE status = 'fooValue'
     * $query->filterByStatus('%fooValue%', Criteria::LIKE); // WHERE status LIKE '%fooValue%'
     * </code>
     *
     * @param     string $status The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCareTestFindingsRadioQuery The current query, for fluid interface
     */
    public function filterByStatus($status = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($status)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CareTestFindingsRadioTableMap::COL_STATUS, $status, $comparison);
    }

    /**
     * Filter the query on the history column
     *
     * Example usage:
     * <code>
     * $query->filterByHistory('fooValue');   // WHERE history = 'fooValue'
     * $query->filterByHistory('%fooValue%', Criteria::LIKE); // WHERE history LIKE '%fooValue%'
     * </code>
     *
     * @param     string $history The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCareTestFindingsRadioQuery The current query, for fluid interface
     */
    public function filterByHistory($history = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($history)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CareTestFindingsRadioTableMap::COL_HISTORY, $history, $comparison);
    }

    /**
     * Filter the query on the modify_id column
     *
     * Example usage:
     * <code>
     * $query->filterByModifyId('fooValue');   // WHERE modify_id = 'fooValue'
     * $query->filterByModifyId('%fooValue%', Criteria::LIKE); // WHERE modify_id LIKE '%fooValue%'
     * </code>
     *
     * @param     string $modifyId The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCareTestFindingsRadioQuery The current query, for fluid interface
     */
    public function filterByModifyId($modifyId = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($modifyId)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CareTestFindingsRadioTableMap::COL_MODIFY_ID, $modifyId, $comparison);
    }

    /**
     * Filter the query on the modify_time column
     *
     * Example usage:
     * <code>
     * $query->filterByModifyTime('2011-03-14'); // WHERE modify_time = '2011-03-14'
     * $query->filterByModifyTime('now'); // WHERE modify_time = '2011-03-14'
     * $query->filterByModifyTime(array('max' => 'yesterday')); // WHERE modify_time > '2011-03-13'
     * </code>
     *
     * @param     mixed $modifyTime The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCareTestFindingsRadioQuery The current query, for fluid interface
     */
    public function filterByModifyTime($modifyTime = null, $comparison = null)
    {
        if (is_array($modifyTime)) {
            $useMinMax = false;
            if (isset($modifyTime['min'])) {
                $this->addUsingAlias(CareTestFindingsRadioTableMap::COL_MODIFY_TIME, $modifyTime['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($modifyTime['max'])) {
                $this->addUsingAlias(CareTestFindingsRadioTableMap::COL_MODIFY_TIME, $modifyTime['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CareTestFindingsRadioTableMap::COL_MODIFY_TIME, $modifyTime, $comparison);
    }

    /**
     * Filter the query on the create_id column
     *
     * Example usage:
     * <code>
     * $query->filterByCreateId('fooValue');   // WHERE create_id = 'fooValue'
     * $query->filterByCreateId('%fooValue%', Criteria::LIKE); // WHERE create_id LIKE '%fooValue%'
     * </code>
     *
     * @param     string $createId The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCareTestFindingsRadioQuery The current query, for fluid interface
     */
    public function filterByCreateId($createId = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($createId)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CareTestFindingsRadioTableMap::COL_CREATE_ID, $createId, $comparison);
    }

    /**
     * Filter the query on the create_time column
     *
     * Example usage:
     * <code>
     * $query->filterByCreateTime('2011-03-14'); // WHERE create_time = '2011-03-14'
     * $query->filterByCreateTime('now'); // WHERE create_time = '2011-03-14'
     * $query->filterByCreateTime(array('max' => 'yesterday')); // WHERE create_time > '2011-03-13'
     * </code>
     *
     * @param     mixed $createTime The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCareTestFindingsRadioQuery The current query, for fluid interface
     */
    public function filterByCreateTime($createTime = null, $comparison = null)
    {
        if (is_array($createTime)) {
            $useMinMax = false;
            if (isset($createTime['min'])) {
                $this->addUsingAlias(CareTestFindingsRadioTableMap::COL_CREATE_TIME, $createTime['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createTime['max'])) {
                $this->addUsingAlias(CareTestFindingsRadioTableMap::COL_CREATE_TIME, $createTime['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CareTestFindingsRadioTableMap::COL_CREATE_TIME, $createTime, $comparison);
    }

    /**
     * Exclude object from result
     *
     * @param   ChildCareTestFindingsRadio $careTestFindingsRadio Object to remove from the list of results
     *
     * @return $this|ChildCareTestFindingsRadioQuery The current query, for fluid interface
     */
    public function prune($careTestFindingsRadio = null)
    {
        if ($careTestFindingsRadio) {
            $this->addCond('pruneCond0', $this->getAliasedColName(CareTestFindingsRadioTableMap::COL_BATCH_NR), $careTestFindingsRadio->getBatchNr(), Criteria::NOT_EQUAL);
            $this->addCond('pruneCond1', $this->getAliasedColName(CareTestFindingsRadioTableMap::COL_ENCOUNTER_NR), $careTestFindingsRadio->getEncounterNr(), Criteria::NOT_EQUAL);
            $this->combine(array('pruneCond0', 'pruneCond1'), Criteria::LOGICAL_OR);
        }

        return $this;
    }

    /**
     * Deletes all rows from the care_test_findings_radio table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(CareTestFindingsRadioTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            CareTestFindingsRadioTableMap::clearInstancePool();
            CareTestFindingsRadioTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(CareTestFindingsRadioTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(CareTestFindingsRadioTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            CareTestFindingsRadioTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            CareTestFindingsRadioTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // CareTestFindingsRadioQuery
