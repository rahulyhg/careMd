<?php

namespace CareMd\CareMd\Base;

use \DateTime;
use \Exception;
use \PDO;
use CareMd\CareMd\CareMedProductsMainQuery as ChildCareMedProductsMainQuery;
use CareMd\CareMd\Map\CareMedProductsMainTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveRecord\ActiveRecordInterface;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\BadMethodCallException;
use Propel\Runtime\Exception\LogicException;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Parser\AbstractParser;
use Propel\Runtime\Util\PropelDateTime;

/**
 * Base class that represents a row from the 'care_med_products_main' table.
 *
 *
 *
 * @package    propel.generator.CareMd.CareMd.Base
 */
abstract class CareMedProductsMain implements ActiveRecordInterface
{
    /**
     * TableMap class name
     */
    const TABLE_MAP = '\\CareMd\\CareMd\\Map\\CareMedProductsMainTableMap';


    /**
     * attribute to determine if this object has previously been saved.
     * @var boolean
     */
    protected $new = true;

    /**
     * attribute to determine whether this object has been deleted.
     * @var boolean
     */
    protected $deleted = false;

    /**
     * The columns that have been modified in current object.
     * Tracking modified columns allows us to only update modified columns.
     * @var array
     */
    protected $modifiedColumns = array();

    /**
     * The (virtual) columns that are added at runtime
     * The formatters can add supplementary columns based on a resultset
     * @var array
     */
    protected $virtualColumns = array();

    /**
     * The value for the bestellnum field.
     *
     * Note: this column has a database default value of: ''
     * @var        string
     */
    protected $bestellnum;

    /**
     * The value for the artikelnum field.
     *
     * @var        string
     */
    protected $artikelnum;

    /**
     * The value for the industrynum field.
     *
     * @var        string
     */
    protected $industrynum;

    /**
     * The value for the artikelname field.
     *
     * @var        string
     */
    protected $artikelname;

    /**
     * The value for the generic field.
     *
     * @var        string
     */
    protected $generic;

    /**
     * The value for the description field.
     *
     * @var        string
     */
    protected $description;

    /**
     * The value for the packing field.
     *
     * @var        string
     */
    protected $packing;

    /**
     * The value for the minorder field.
     *
     * Note: this column has a database default value of: 0
     * @var        int
     */
    protected $minorder;

    /**
     * The value for the maxorder field.
     *
     * Note: this column has a database default value of: 0
     * @var        int
     */
    protected $maxorder;

    /**
     * The value for the proorder field.
     *
     * @var        string
     */
    protected $proorder;

    /**
     * The value for the picfile field.
     *
     * @var        string
     */
    protected $picfile;

    /**
     * The value for the encoder field.
     *
     * @var        string
     */
    protected $encoder;

    /**
     * The value for the enc_date field.
     *
     * @var        string
     */
    protected $enc_date;

    /**
     * The value for the enc_time field.
     *
     * @var        string
     */
    protected $enc_time;

    /**
     * The value for the lock_flag field.
     *
     * Note: this column has a database default value of: false
     * @var        boolean
     */
    protected $lock_flag;

    /**
     * The value for the medgroup field.
     *
     * @var        string
     */
    protected $medgroup;

    /**
     * The value for the cave field.
     *
     * @var        string
     */
    protected $cave;

    /**
     * The value for the status field.
     *
     * Note: this column has a database default value of: ''
     * @var        string
     */
    protected $status;

    /**
     * The value for the history field.
     *
     * @var        string
     */
    protected $history;

    /**
     * The value for the modify_id field.
     *
     * Note: this column has a database default value of: ''
     * @var        string
     */
    protected $modify_id;

    /**
     * The value for the modify_time field.
     *
     * Note: this column has a database default value of: (expression) CURRENT_TIMESTAMP
     * @var        DateTime
     */
    protected $modify_time;

    /**
     * The value for the create_id field.
     *
     * Note: this column has a database default value of: ''
     * @var        string
     */
    protected $create_id;

    /**
     * The value for the create_time field.
     *
     * Note: this column has a database default value of: NULL
     * @var        DateTime
     */
    protected $create_time;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var boolean
     */
    protected $alreadyInSave = false;

    /**
     * Applies default values to this object.
     * This method should be called from the object's constructor (or
     * equivalent initialization method).
     * @see __construct()
     */
    public function applyDefaultValues()
    {
        $this->bestellnum = '';
        $this->minorder = 0;
        $this->maxorder = 0;
        $this->lock_flag = false;
        $this->status = '';
        $this->modify_id = '';
        $this->create_id = '';
        $this->create_time = PropelDateTime::newInstance(NULL, null, 'DateTime');
    }

    /**
     * Initializes internal state of CareMd\CareMd\Base\CareMedProductsMain object.
     * @see applyDefaults()
     */
    public function __construct()
    {
        $this->applyDefaultValues();
    }

    /**
     * Returns whether the object has been modified.
     *
     * @return boolean True if the object has been modified.
     */
    public function isModified()
    {
        return !!$this->modifiedColumns;
    }

    /**
     * Has specified column been modified?
     *
     * @param  string  $col column fully qualified name (TableMap::TYPE_COLNAME), e.g. Book::AUTHOR_ID
     * @return boolean True if $col has been modified.
     */
    public function isColumnModified($col)
    {
        return $this->modifiedColumns && isset($this->modifiedColumns[$col]);
    }

    /**
     * Get the columns that have been modified in this object.
     * @return array A unique list of the modified column names for this object.
     */
    public function getModifiedColumns()
    {
        return $this->modifiedColumns ? array_keys($this->modifiedColumns) : [];
    }

    /**
     * Returns whether the object has ever been saved.  This will
     * be false, if the object was retrieved from storage or was created
     * and then saved.
     *
     * @return boolean true, if the object has never been persisted.
     */
    public function isNew()
    {
        return $this->new;
    }

    /**
     * Setter for the isNew attribute.  This method will be called
     * by Propel-generated children and objects.
     *
     * @param boolean $b the state of the object.
     */
    public function setNew($b)
    {
        $this->new = (boolean) $b;
    }

    /**
     * Whether this object has been deleted.
     * @return boolean The deleted state of this object.
     */
    public function isDeleted()
    {
        return $this->deleted;
    }

    /**
     * Specify whether this object has been deleted.
     * @param  boolean $b The deleted state of this object.
     * @return void
     */
    public function setDeleted($b)
    {
        $this->deleted = (boolean) $b;
    }

    /**
     * Sets the modified state for the object to be false.
     * @param  string $col If supplied, only the specified column is reset.
     * @return void
     */
    public function resetModified($col = null)
    {
        if (null !== $col) {
            if (isset($this->modifiedColumns[$col])) {
                unset($this->modifiedColumns[$col]);
            }
        } else {
            $this->modifiedColumns = array();
        }
    }

    /**
     * Compares this with another <code>CareMedProductsMain</code> instance.  If
     * <code>obj</code> is an instance of <code>CareMedProductsMain</code>, delegates to
     * <code>equals(CareMedProductsMain)</code>.  Otherwise, returns <code>false</code>.
     *
     * @param  mixed   $obj The object to compare to.
     * @return boolean Whether equal to the object specified.
     */
    public function equals($obj)
    {
        if (!$obj instanceof static) {
            return false;
        }

        if ($this === $obj) {
            return true;
        }

        if (null === $this->getPrimaryKey() || null === $obj->getPrimaryKey()) {
            return false;
        }

        return $this->getPrimaryKey() === $obj->getPrimaryKey();
    }

    /**
     * Get the associative array of the virtual columns in this object
     *
     * @return array
     */
    public function getVirtualColumns()
    {
        return $this->virtualColumns;
    }

    /**
     * Checks the existence of a virtual column in this object
     *
     * @param  string  $name The virtual column name
     * @return boolean
     */
    public function hasVirtualColumn($name)
    {
        return array_key_exists($name, $this->virtualColumns);
    }

    /**
     * Get the value of a virtual column in this object
     *
     * @param  string $name The virtual column name
     * @return mixed
     *
     * @throws PropelException
     */
    public function getVirtualColumn($name)
    {
        if (!$this->hasVirtualColumn($name)) {
            throw new PropelException(sprintf('Cannot get value of inexistent virtual column %s.', $name));
        }

        return $this->virtualColumns[$name];
    }

    /**
     * Set the value of a virtual column in this object
     *
     * @param string $name  The virtual column name
     * @param mixed  $value The value to give to the virtual column
     *
     * @return $this|CareMedProductsMain The current object, for fluid interface
     */
    public function setVirtualColumn($name, $value)
    {
        $this->virtualColumns[$name] = $value;

        return $this;
    }

    /**
     * Logs a message using Propel::log().
     *
     * @param  string  $msg
     * @param  int     $priority One of the Propel::LOG_* logging levels
     * @return boolean
     */
    protected function log($msg, $priority = Propel::LOG_INFO)
    {
        return Propel::log(get_class($this) . ': ' . $msg, $priority);
    }

    /**
     * Export the current object properties to a string, using a given parser format
     * <code>
     * $book = BookQuery::create()->findPk(9012);
     * echo $book->exportTo('JSON');
     *  => {"Id":9012,"Title":"Don Juan","ISBN":"0140422161","Price":12.99,"PublisherId":1234,"AuthorId":5678}');
     * </code>
     *
     * @param  mixed   $parser                 A AbstractParser instance, or a format name ('XML', 'YAML', 'JSON', 'CSV')
     * @param  boolean $includeLazyLoadColumns (optional) Whether to include lazy load(ed) columns. Defaults to TRUE.
     * @return string  The exported data
     */
    public function exportTo($parser, $includeLazyLoadColumns = true)
    {
        if (!$parser instanceof AbstractParser) {
            $parser = AbstractParser::getParser($parser);
        }

        return $parser->fromArray($this->toArray(TableMap::TYPE_PHPNAME, $includeLazyLoadColumns, array(), true));
    }

    /**
     * Clean up internal collections prior to serializing
     * Avoids recursive loops that turn into segmentation faults when serializing
     */
    public function __sleep()
    {
        $this->clearAllReferences();

        $cls = new \ReflectionClass($this);
        $propertyNames = [];
        $serializableProperties = array_diff($cls->getProperties(), $cls->getProperties(\ReflectionProperty::IS_STATIC));

        foreach($serializableProperties as $property) {
            $propertyNames[] = $property->getName();
        }

        return $propertyNames;
    }

    /**
     * Get the [bestellnum] column value.
     *
     * @return string
     */
    public function getBestellnum()
    {
        return $this->bestellnum;
    }

    /**
     * Get the [artikelnum] column value.
     *
     * @return string
     */
    public function getArtikelnum()
    {
        return $this->artikelnum;
    }

    /**
     * Get the [industrynum] column value.
     *
     * @return string
     */
    public function getIndustrynum()
    {
        return $this->industrynum;
    }

    /**
     * Get the [artikelname] column value.
     *
     * @return string
     */
    public function getArtikelname()
    {
        return $this->artikelname;
    }

    /**
     * Get the [generic] column value.
     *
     * @return string
     */
    public function getGeneric()
    {
        return $this->generic;
    }

    /**
     * Get the [description] column value.
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Get the [packing] column value.
     *
     * @return string
     */
    public function getPacking()
    {
        return $this->packing;
    }

    /**
     * Get the [minorder] column value.
     *
     * @return int
     */
    public function getMinorder()
    {
        return $this->minorder;
    }

    /**
     * Get the [maxorder] column value.
     *
     * @return int
     */
    public function getMaxorder()
    {
        return $this->maxorder;
    }

    /**
     * Get the [proorder] column value.
     *
     * @return string
     */
    public function getProorder()
    {
        return $this->proorder;
    }

    /**
     * Get the [picfile] column value.
     *
     * @return string
     */
    public function getPicfile()
    {
        return $this->picfile;
    }

    /**
     * Get the [encoder] column value.
     *
     * @return string
     */
    public function getEncoder()
    {
        return $this->encoder;
    }

    /**
     * Get the [enc_date] column value.
     *
     * @return string
     */
    public function getEncDate()
    {
        return $this->enc_date;
    }

    /**
     * Get the [enc_time] column value.
     *
     * @return string
     */
    public function getEncTime()
    {
        return $this->enc_time;
    }

    /**
     * Get the [lock_flag] column value.
     *
     * @return boolean
     */
    public function getLockFlag()
    {
        return $this->lock_flag;
    }

    /**
     * Get the [lock_flag] column value.
     *
     * @return boolean
     */
    public function isLockFlag()
    {
        return $this->getLockFlag();
    }

    /**
     * Get the [medgroup] column value.
     *
     * @return string
     */
    public function getMedgroup()
    {
        return $this->medgroup;
    }

    /**
     * Get the [cave] column value.
     *
     * @return string
     */
    public function getCave()
    {
        return $this->cave;
    }

    /**
     * Get the [status] column value.
     *
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Get the [history] column value.
     *
     * @return string
     */
    public function getHistory()
    {
        return $this->history;
    }

    /**
     * Get the [modify_id] column value.
     *
     * @return string
     */
    public function getModifyId()
    {
        return $this->modify_id;
    }

    /**
     * Get the [optionally formatted] temporal [modify_time] column value.
     *
     *
     * @param      string|null $format The date/time format string (either date()-style or strftime()-style).
     *                            If format is NULL, then the raw DateTime object will be returned.
     *
     * @return string|DateTime Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00 00:00:00
     *
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getModifyTime($format = NULL)
    {
        if ($format === null) {
            return $this->modify_time;
        } else {
            return $this->modify_time instanceof \DateTimeInterface ? $this->modify_time->format($format) : null;
        }
    }

    /**
     * Get the [create_id] column value.
     *
     * @return string
     */
    public function getCreateId()
    {
        return $this->create_id;
    }

    /**
     * Get the [optionally formatted] temporal [create_time] column value.
     *
     *
     * @param      string|null $format The date/time format string (either date()-style or strftime()-style).
     *                            If format is NULL, then the raw DateTime object will be returned.
     *
     * @return string|DateTime Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00 00:00:00
     *
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getCreateTime($format = NULL)
    {
        if ($format === null) {
            return $this->create_time;
        } else {
            return $this->create_time instanceof \DateTimeInterface ? $this->create_time->format($format) : null;
        }
    }

    /**
     * Set the value of [bestellnum] column.
     *
     * @param string $v new value
     * @return $this|\CareMd\CareMd\CareMedProductsMain The current object (for fluent API support)
     */
    public function setBestellnum($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->bestellnum !== $v) {
            $this->bestellnum = $v;
            $this->modifiedColumns[CareMedProductsMainTableMap::COL_BESTELLNUM] = true;
        }

        return $this;
    } // setBestellnum()

    /**
     * Set the value of [artikelnum] column.
     *
     * @param string $v new value
     * @return $this|\CareMd\CareMd\CareMedProductsMain The current object (for fluent API support)
     */
    public function setArtikelnum($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->artikelnum !== $v) {
            $this->artikelnum = $v;
            $this->modifiedColumns[CareMedProductsMainTableMap::COL_ARTIKELNUM] = true;
        }

        return $this;
    } // setArtikelnum()

    /**
     * Set the value of [industrynum] column.
     *
     * @param string $v new value
     * @return $this|\CareMd\CareMd\CareMedProductsMain The current object (for fluent API support)
     */
    public function setIndustrynum($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->industrynum !== $v) {
            $this->industrynum = $v;
            $this->modifiedColumns[CareMedProductsMainTableMap::COL_INDUSTRYNUM] = true;
        }

        return $this;
    } // setIndustrynum()

    /**
     * Set the value of [artikelname] column.
     *
     * @param string $v new value
     * @return $this|\CareMd\CareMd\CareMedProductsMain The current object (for fluent API support)
     */
    public function setArtikelname($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->artikelname !== $v) {
            $this->artikelname = $v;
            $this->modifiedColumns[CareMedProductsMainTableMap::COL_ARTIKELNAME] = true;
        }

        return $this;
    } // setArtikelname()

    /**
     * Set the value of [generic] column.
     *
     * @param string $v new value
     * @return $this|\CareMd\CareMd\CareMedProductsMain The current object (for fluent API support)
     */
    public function setGeneric($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->generic !== $v) {
            $this->generic = $v;
            $this->modifiedColumns[CareMedProductsMainTableMap::COL_GENERIC] = true;
        }

        return $this;
    } // setGeneric()

    /**
     * Set the value of [description] column.
     *
     * @param string $v new value
     * @return $this|\CareMd\CareMd\CareMedProductsMain The current object (for fluent API support)
     */
    public function setDescription($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->description !== $v) {
            $this->description = $v;
            $this->modifiedColumns[CareMedProductsMainTableMap::COL_DESCRIPTION] = true;
        }

        return $this;
    } // setDescription()

    /**
     * Set the value of [packing] column.
     *
     * @param string $v new value
     * @return $this|\CareMd\CareMd\CareMedProductsMain The current object (for fluent API support)
     */
    public function setPacking($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->packing !== $v) {
            $this->packing = $v;
            $this->modifiedColumns[CareMedProductsMainTableMap::COL_PACKING] = true;
        }

        return $this;
    } // setPacking()

    /**
     * Set the value of [minorder] column.
     *
     * @param int $v new value
     * @return $this|\CareMd\CareMd\CareMedProductsMain The current object (for fluent API support)
     */
    public function setMinorder($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->minorder !== $v) {
            $this->minorder = $v;
            $this->modifiedColumns[CareMedProductsMainTableMap::COL_MINORDER] = true;
        }

        return $this;
    } // setMinorder()

    /**
     * Set the value of [maxorder] column.
     *
     * @param int $v new value
     * @return $this|\CareMd\CareMd\CareMedProductsMain The current object (for fluent API support)
     */
    public function setMaxorder($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->maxorder !== $v) {
            $this->maxorder = $v;
            $this->modifiedColumns[CareMedProductsMainTableMap::COL_MAXORDER] = true;
        }

        return $this;
    } // setMaxorder()

    /**
     * Set the value of [proorder] column.
     *
     * @param string $v new value
     * @return $this|\CareMd\CareMd\CareMedProductsMain The current object (for fluent API support)
     */
    public function setProorder($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->proorder !== $v) {
            $this->proorder = $v;
            $this->modifiedColumns[CareMedProductsMainTableMap::COL_PROORDER] = true;
        }

        return $this;
    } // setProorder()

    /**
     * Set the value of [picfile] column.
     *
     * @param string $v new value
     * @return $this|\CareMd\CareMd\CareMedProductsMain The current object (for fluent API support)
     */
    public function setPicfile($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->picfile !== $v) {
            $this->picfile = $v;
            $this->modifiedColumns[CareMedProductsMainTableMap::COL_PICFILE] = true;
        }

        return $this;
    } // setPicfile()

    /**
     * Set the value of [encoder] column.
     *
     * @param string $v new value
     * @return $this|\CareMd\CareMd\CareMedProductsMain The current object (for fluent API support)
     */
    public function setEncoder($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->encoder !== $v) {
            $this->encoder = $v;
            $this->modifiedColumns[CareMedProductsMainTableMap::COL_ENCODER] = true;
        }

        return $this;
    } // setEncoder()

    /**
     * Set the value of [enc_date] column.
     *
     * @param string $v new value
     * @return $this|\CareMd\CareMd\CareMedProductsMain The current object (for fluent API support)
     */
    public function setEncDate($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->enc_date !== $v) {
            $this->enc_date = $v;
            $this->modifiedColumns[CareMedProductsMainTableMap::COL_ENC_DATE] = true;
        }

        return $this;
    } // setEncDate()

    /**
     * Set the value of [enc_time] column.
     *
     * @param string $v new value
     * @return $this|\CareMd\CareMd\CareMedProductsMain The current object (for fluent API support)
     */
    public function setEncTime($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->enc_time !== $v) {
            $this->enc_time = $v;
            $this->modifiedColumns[CareMedProductsMainTableMap::COL_ENC_TIME] = true;
        }

        return $this;
    } // setEncTime()

    /**
     * Sets the value of the [lock_flag] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     *
     * @param  boolean|integer|string $v The new value
     * @return $this|\CareMd\CareMd\CareMedProductsMain The current object (for fluent API support)
     */
    public function setLockFlag($v)
    {
        if ($v !== null) {
            if (is_string($v)) {
                $v = in_array(strtolower($v), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
            } else {
                $v = (boolean) $v;
            }
        }

        if ($this->lock_flag !== $v) {
            $this->lock_flag = $v;
            $this->modifiedColumns[CareMedProductsMainTableMap::COL_LOCK_FLAG] = true;
        }

        return $this;
    } // setLockFlag()

    /**
     * Set the value of [medgroup] column.
     *
     * @param string $v new value
     * @return $this|\CareMd\CareMd\CareMedProductsMain The current object (for fluent API support)
     */
    public function setMedgroup($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->medgroup !== $v) {
            $this->medgroup = $v;
            $this->modifiedColumns[CareMedProductsMainTableMap::COL_MEDGROUP] = true;
        }

        return $this;
    } // setMedgroup()

    /**
     * Set the value of [cave] column.
     *
     * @param string $v new value
     * @return $this|\CareMd\CareMd\CareMedProductsMain The current object (for fluent API support)
     */
    public function setCave($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->cave !== $v) {
            $this->cave = $v;
            $this->modifiedColumns[CareMedProductsMainTableMap::COL_CAVE] = true;
        }

        return $this;
    } // setCave()

    /**
     * Set the value of [status] column.
     *
     * @param string $v new value
     * @return $this|\CareMd\CareMd\CareMedProductsMain The current object (for fluent API support)
     */
    public function setStatus($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->status !== $v) {
            $this->status = $v;
            $this->modifiedColumns[CareMedProductsMainTableMap::COL_STATUS] = true;
        }

        return $this;
    } // setStatus()

    /**
     * Set the value of [history] column.
     *
     * @param string $v new value
     * @return $this|\CareMd\CareMd\CareMedProductsMain The current object (for fluent API support)
     */
    public function setHistory($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->history !== $v) {
            $this->history = $v;
            $this->modifiedColumns[CareMedProductsMainTableMap::COL_HISTORY] = true;
        }

        return $this;
    } // setHistory()

    /**
     * Set the value of [modify_id] column.
     *
     * @param string $v new value
     * @return $this|\CareMd\CareMd\CareMedProductsMain The current object (for fluent API support)
     */
    public function setModifyId($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->modify_id !== $v) {
            $this->modify_id = $v;
            $this->modifiedColumns[CareMedProductsMainTableMap::COL_MODIFY_ID] = true;
        }

        return $this;
    } // setModifyId()

    /**
     * Sets the value of [modify_time] column to a normalized version of the date/time value specified.
     *
     * @param  mixed $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this|\CareMd\CareMd\CareMedProductsMain The current object (for fluent API support)
     */
    public function setModifyTime($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->modify_time !== null || $dt !== null) {
            if ($this->modify_time === null || $dt === null || $dt->format("Y-m-d H:i:s.u") !== $this->modify_time->format("Y-m-d H:i:s.u")) {
                $this->modify_time = $dt === null ? null : clone $dt;
                $this->modifiedColumns[CareMedProductsMainTableMap::COL_MODIFY_TIME] = true;
            }
        } // if either are not null

        return $this;
    } // setModifyTime()

    /**
     * Set the value of [create_id] column.
     *
     * @param string $v new value
     * @return $this|\CareMd\CareMd\CareMedProductsMain The current object (for fluent API support)
     */
    public function setCreateId($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->create_id !== $v) {
            $this->create_id = $v;
            $this->modifiedColumns[CareMedProductsMainTableMap::COL_CREATE_ID] = true;
        }

        return $this;
    } // setCreateId()

    /**
     * Sets the value of [create_time] column to a normalized version of the date/time value specified.
     *
     * @param  mixed $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this|\CareMd\CareMd\CareMedProductsMain The current object (for fluent API support)
     */
    public function setCreateTime($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->create_time !== null || $dt !== null) {
            if ( ($dt != $this->create_time) // normalized values don't match
                || ($dt->format('Y-m-d H:i:s.u') === NULL) // or the entered value matches the default
                 ) {
                $this->create_time = $dt === null ? null : clone $dt;
                $this->modifiedColumns[CareMedProductsMainTableMap::COL_CREATE_TIME] = true;
            }
        } // if either are not null

        return $this;
    } // setCreateTime()

    /**
     * Indicates whether the columns in this object are only set to default values.
     *
     * This method can be used in conjunction with isModified() to indicate whether an object is both
     * modified _and_ has some values set which are non-default.
     *
     * @return boolean Whether the columns in this object are only been set with default values.
     */
    public function hasOnlyDefaultValues()
    {
            if ($this->bestellnum !== '') {
                return false;
            }

            if ($this->minorder !== 0) {
                return false;
            }

            if ($this->maxorder !== 0) {
                return false;
            }

            if ($this->lock_flag !== false) {
                return false;
            }

            if ($this->status !== '') {
                return false;
            }

            if ($this->modify_id !== '') {
                return false;
            }

            if ($this->create_id !== '') {
                return false;
            }

            if ($this->create_time && $this->create_time->format('Y-m-d H:i:s.u') !== NULL) {
                return false;
            }

        // otherwise, everything was equal, so return TRUE
        return true;
    } // hasOnlyDefaultValues()

    /**
     * Hydrates (populates) the object variables with values from the database resultset.
     *
     * An offset (0-based "start column") is specified so that objects can be hydrated
     * with a subset of the columns in the resultset rows.  This is needed, for example,
     * for results of JOIN queries where the resultset row includes columns from two or
     * more tables.
     *
     * @param array   $row       The row returned by DataFetcher->fetch().
     * @param int     $startcol  0-based offset column which indicates which restultset column to start with.
     * @param boolean $rehydrate Whether this object is being re-hydrated from the database.
     * @param string  $indexType The index type of $row. Mostly DataFetcher->getIndexType().
                                  One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                            TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *
     * @return int             next starting column
     * @throws PropelException - Any caught Exception will be rewrapped as a PropelException.
     */
    public function hydrate($row, $startcol = 0, $rehydrate = false, $indexType = TableMap::TYPE_NUM)
    {
        try {

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : CareMedProductsMainTableMap::translateFieldName('Bestellnum', TableMap::TYPE_PHPNAME, $indexType)];
            $this->bestellnum = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : CareMedProductsMainTableMap::translateFieldName('Artikelnum', TableMap::TYPE_PHPNAME, $indexType)];
            $this->artikelnum = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : CareMedProductsMainTableMap::translateFieldName('Industrynum', TableMap::TYPE_PHPNAME, $indexType)];
            $this->industrynum = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : CareMedProductsMainTableMap::translateFieldName('Artikelname', TableMap::TYPE_PHPNAME, $indexType)];
            $this->artikelname = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : CareMedProductsMainTableMap::translateFieldName('Generic', TableMap::TYPE_PHPNAME, $indexType)];
            $this->generic = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : CareMedProductsMainTableMap::translateFieldName('Description', TableMap::TYPE_PHPNAME, $indexType)];
            $this->description = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : CareMedProductsMainTableMap::translateFieldName('Packing', TableMap::TYPE_PHPNAME, $indexType)];
            $this->packing = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : CareMedProductsMainTableMap::translateFieldName('Minorder', TableMap::TYPE_PHPNAME, $indexType)];
            $this->minorder = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 8 + $startcol : CareMedProductsMainTableMap::translateFieldName('Maxorder', TableMap::TYPE_PHPNAME, $indexType)];
            $this->maxorder = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 9 + $startcol : CareMedProductsMainTableMap::translateFieldName('Proorder', TableMap::TYPE_PHPNAME, $indexType)];
            $this->proorder = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 10 + $startcol : CareMedProductsMainTableMap::translateFieldName('Picfile', TableMap::TYPE_PHPNAME, $indexType)];
            $this->picfile = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 11 + $startcol : CareMedProductsMainTableMap::translateFieldName('Encoder', TableMap::TYPE_PHPNAME, $indexType)];
            $this->encoder = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 12 + $startcol : CareMedProductsMainTableMap::translateFieldName('EncDate', TableMap::TYPE_PHPNAME, $indexType)];
            $this->enc_date = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 13 + $startcol : CareMedProductsMainTableMap::translateFieldName('EncTime', TableMap::TYPE_PHPNAME, $indexType)];
            $this->enc_time = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 14 + $startcol : CareMedProductsMainTableMap::translateFieldName('LockFlag', TableMap::TYPE_PHPNAME, $indexType)];
            $this->lock_flag = (null !== $col) ? (boolean) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 15 + $startcol : CareMedProductsMainTableMap::translateFieldName('Medgroup', TableMap::TYPE_PHPNAME, $indexType)];
            $this->medgroup = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 16 + $startcol : CareMedProductsMainTableMap::translateFieldName('Cave', TableMap::TYPE_PHPNAME, $indexType)];
            $this->cave = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 17 + $startcol : CareMedProductsMainTableMap::translateFieldName('Status', TableMap::TYPE_PHPNAME, $indexType)];
            $this->status = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 18 + $startcol : CareMedProductsMainTableMap::translateFieldName('History', TableMap::TYPE_PHPNAME, $indexType)];
            $this->history = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 19 + $startcol : CareMedProductsMainTableMap::translateFieldName('ModifyId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->modify_id = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 20 + $startcol : CareMedProductsMainTableMap::translateFieldName('ModifyTime', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->modify_time = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 21 + $startcol : CareMedProductsMainTableMap::translateFieldName('CreateId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->create_id = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 22 + $startcol : CareMedProductsMainTableMap::translateFieldName('CreateTime', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->create_time = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 23; // 23 = CareMedProductsMainTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\CareMd\\CareMd\\CareMedProductsMain'), 0, $e);
        }
    }

    /**
     * Checks and repairs the internal consistency of the object.
     *
     * This method is executed after an already-instantiated object is re-hydrated
     * from the database.  It exists to check any foreign keys to make sure that
     * the objects related to the current object are correct based on foreign key.
     *
     * You can override this method in the stub class, but you should always invoke
     * the base method from the overridden method (i.e. parent::ensureConsistency()),
     * in case your model changes.
     *
     * @throws PropelException
     */
    public function ensureConsistency()
    {
    } // ensureConsistency

    /**
     * Reloads this object from datastore based on primary key and (optionally) resets all associated objects.
     *
     * This will only work if the object has been saved and has a valid primary key set.
     *
     * @param      boolean $deep (optional) Whether to also de-associated any related objects.
     * @param      ConnectionInterface $con (optional) The ConnectionInterface connection to use.
     * @return void
     * @throws PropelException - if this object is deleted, unsaved or doesn't have pk match in db
     */
    public function reload($deep = false, ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("Cannot reload a deleted object.");
        }

        if ($this->isNew()) {
            throw new PropelException("Cannot reload an unsaved object.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(CareMedProductsMainTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildCareMedProductsMainQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param      ConnectionInterface $con
     * @return void
     * @throws PropelException
     * @see CareMedProductsMain::setDeleted()
     * @see CareMedProductsMain::isDeleted()
     */
    public function delete(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(CareMedProductsMainTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildCareMedProductsMainQuery::create()
                ->filterByPrimaryKey($this->getPrimaryKey());
            $ret = $this->preDelete($con);
            if ($ret) {
                $deleteQuery->delete($con);
                $this->postDelete($con);
                $this->setDeleted(true);
            }
        });
    }

    /**
     * Persists this object to the database.
     *
     * If the object is new, it inserts it; otherwise an update is performed.
     * All modified related objects will also be persisted in the doSave()
     * method.  This method wraps all precipitate database operations in a
     * single transaction.
     *
     * @param      ConnectionInterface $con
     * @return int             The number of rows affected by this insert/update and any referring fk objects' save() operations.
     * @throws PropelException
     * @see doSave()
     */
    public function save(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("You cannot save an object that has been deleted.");
        }

        if ($this->alreadyInSave) {
            return 0;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(CareMedProductsMainTableMap::DATABASE_NAME);
        }

        return $con->transaction(function () use ($con) {
            $ret = $this->preSave($con);
            $isInsert = $this->isNew();
            if ($isInsert) {
                $ret = $ret && $this->preInsert($con);
            } else {
                $ret = $ret && $this->preUpdate($con);
            }
            if ($ret) {
                $affectedRows = $this->doSave($con);
                if ($isInsert) {
                    $this->postInsert($con);
                } else {
                    $this->postUpdate($con);
                }
                $this->postSave($con);
                CareMedProductsMainTableMap::addInstanceToPool($this);
            } else {
                $affectedRows = 0;
            }

            return $affectedRows;
        });
    }

    /**
     * Performs the work of inserting or updating the row in the database.
     *
     * If the object is new, it inserts it; otherwise an update is performed.
     * All related objects are also updated in this method.
     *
     * @param      ConnectionInterface $con
     * @return int             The number of rows affected by this insert/update and any referring fk objects' save() operations.
     * @throws PropelException
     * @see save()
     */
    protected function doSave(ConnectionInterface $con)
    {
        $affectedRows = 0; // initialize var to track total num of affected rows
        if (!$this->alreadyInSave) {
            $this->alreadyInSave = true;

            if ($this->isNew() || $this->isModified()) {
                // persist changes
                if ($this->isNew()) {
                    $this->doInsert($con);
                    $affectedRows += 1;
                } else {
                    $affectedRows += $this->doUpdate($con);
                }
                $this->resetModified();
            }

            $this->alreadyInSave = false;

        }

        return $affectedRows;
    } // doSave()

    /**
     * Insert the row in the database.
     *
     * @param      ConnectionInterface $con
     *
     * @throws PropelException
     * @see doSave()
     */
    protected function doInsert(ConnectionInterface $con)
    {
        $modifiedColumns = array();
        $index = 0;


         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(CareMedProductsMainTableMap::COL_BESTELLNUM)) {
            $modifiedColumns[':p' . $index++]  = 'bestellnum';
        }
        if ($this->isColumnModified(CareMedProductsMainTableMap::COL_ARTIKELNUM)) {
            $modifiedColumns[':p' . $index++]  = 'artikelnum';
        }
        if ($this->isColumnModified(CareMedProductsMainTableMap::COL_INDUSTRYNUM)) {
            $modifiedColumns[':p' . $index++]  = 'industrynum';
        }
        if ($this->isColumnModified(CareMedProductsMainTableMap::COL_ARTIKELNAME)) {
            $modifiedColumns[':p' . $index++]  = 'artikelname';
        }
        if ($this->isColumnModified(CareMedProductsMainTableMap::COL_GENERIC)) {
            $modifiedColumns[':p' . $index++]  = 'generic';
        }
        if ($this->isColumnModified(CareMedProductsMainTableMap::COL_DESCRIPTION)) {
            $modifiedColumns[':p' . $index++]  = 'description';
        }
        if ($this->isColumnModified(CareMedProductsMainTableMap::COL_PACKING)) {
            $modifiedColumns[':p' . $index++]  = 'packing';
        }
        if ($this->isColumnModified(CareMedProductsMainTableMap::COL_MINORDER)) {
            $modifiedColumns[':p' . $index++]  = 'minorder';
        }
        if ($this->isColumnModified(CareMedProductsMainTableMap::COL_MAXORDER)) {
            $modifiedColumns[':p' . $index++]  = 'maxorder';
        }
        if ($this->isColumnModified(CareMedProductsMainTableMap::COL_PROORDER)) {
            $modifiedColumns[':p' . $index++]  = 'proorder';
        }
        if ($this->isColumnModified(CareMedProductsMainTableMap::COL_PICFILE)) {
            $modifiedColumns[':p' . $index++]  = 'picfile';
        }
        if ($this->isColumnModified(CareMedProductsMainTableMap::COL_ENCODER)) {
            $modifiedColumns[':p' . $index++]  = 'encoder';
        }
        if ($this->isColumnModified(CareMedProductsMainTableMap::COL_ENC_DATE)) {
            $modifiedColumns[':p' . $index++]  = 'enc_date';
        }
        if ($this->isColumnModified(CareMedProductsMainTableMap::COL_ENC_TIME)) {
            $modifiedColumns[':p' . $index++]  = 'enc_time';
        }
        if ($this->isColumnModified(CareMedProductsMainTableMap::COL_LOCK_FLAG)) {
            $modifiedColumns[':p' . $index++]  = 'lock_flag';
        }
        if ($this->isColumnModified(CareMedProductsMainTableMap::COL_MEDGROUP)) {
            $modifiedColumns[':p' . $index++]  = 'medgroup';
        }
        if ($this->isColumnModified(CareMedProductsMainTableMap::COL_CAVE)) {
            $modifiedColumns[':p' . $index++]  = 'cave';
        }
        if ($this->isColumnModified(CareMedProductsMainTableMap::COL_STATUS)) {
            $modifiedColumns[':p' . $index++]  = 'status';
        }
        if ($this->isColumnModified(CareMedProductsMainTableMap::COL_HISTORY)) {
            $modifiedColumns[':p' . $index++]  = 'history';
        }
        if ($this->isColumnModified(CareMedProductsMainTableMap::COL_MODIFY_ID)) {
            $modifiedColumns[':p' . $index++]  = 'modify_id';
        }
        if ($this->isColumnModified(CareMedProductsMainTableMap::COL_MODIFY_TIME)) {
            $modifiedColumns[':p' . $index++]  = 'modify_time';
        }
        if ($this->isColumnModified(CareMedProductsMainTableMap::COL_CREATE_ID)) {
            $modifiedColumns[':p' . $index++]  = 'create_id';
        }
        if ($this->isColumnModified(CareMedProductsMainTableMap::COL_CREATE_TIME)) {
            $modifiedColumns[':p' . $index++]  = 'create_time';
        }

        $sql = sprintf(
            'INSERT INTO care_med_products_main (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case 'bestellnum':
                        $stmt->bindValue($identifier, $this->bestellnum, PDO::PARAM_STR);
                        break;
                    case 'artikelnum':
                        $stmt->bindValue($identifier, $this->artikelnum, PDO::PARAM_STR);
                        break;
                    case 'industrynum':
                        $stmt->bindValue($identifier, $this->industrynum, PDO::PARAM_STR);
                        break;
                    case 'artikelname':
                        $stmt->bindValue($identifier, $this->artikelname, PDO::PARAM_STR);
                        break;
                    case 'generic':
                        $stmt->bindValue($identifier, $this->generic, PDO::PARAM_STR);
                        break;
                    case 'description':
                        $stmt->bindValue($identifier, $this->description, PDO::PARAM_STR);
                        break;
                    case 'packing':
                        $stmt->bindValue($identifier, $this->packing, PDO::PARAM_STR);
                        break;
                    case 'minorder':
                        $stmt->bindValue($identifier, $this->minorder, PDO::PARAM_INT);
                        break;
                    case 'maxorder':
                        $stmt->bindValue($identifier, $this->maxorder, PDO::PARAM_INT);
                        break;
                    case 'proorder':
                        $stmt->bindValue($identifier, $this->proorder, PDO::PARAM_STR);
                        break;
                    case 'picfile':
                        $stmt->bindValue($identifier, $this->picfile, PDO::PARAM_STR);
                        break;
                    case 'encoder':
                        $stmt->bindValue($identifier, $this->encoder, PDO::PARAM_STR);
                        break;
                    case 'enc_date':
                        $stmt->bindValue($identifier, $this->enc_date, PDO::PARAM_STR);
                        break;
                    case 'enc_time':
                        $stmt->bindValue($identifier, $this->enc_time, PDO::PARAM_STR);
                        break;
                    case 'lock_flag':
                        $stmt->bindValue($identifier, (int) $this->lock_flag, PDO::PARAM_INT);
                        break;
                    case 'medgroup':
                        $stmt->bindValue($identifier, $this->medgroup, PDO::PARAM_STR);
                        break;
                    case 'cave':
                        $stmt->bindValue($identifier, $this->cave, PDO::PARAM_STR);
                        break;
                    case 'status':
                        $stmt->bindValue($identifier, $this->status, PDO::PARAM_STR);
                        break;
                    case 'history':
                        $stmt->bindValue($identifier, $this->history, PDO::PARAM_STR);
                        break;
                    case 'modify_id':
                        $stmt->bindValue($identifier, $this->modify_id, PDO::PARAM_STR);
                        break;
                    case 'modify_time':
                        $stmt->bindValue($identifier, $this->modify_time ? $this->modify_time->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);
                        break;
                    case 'create_id':
                        $stmt->bindValue($identifier, $this->create_id, PDO::PARAM_STR);
                        break;
                    case 'create_time':
                        $stmt->bindValue($identifier, $this->create_time ? $this->create_time->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);
                        break;
                }
            }
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute INSERT statement [%s]', $sql), 0, $e);
        }

        $this->setNew(false);
    }

    /**
     * Update the row in the database.
     *
     * @param      ConnectionInterface $con
     *
     * @return Integer Number of updated rows
     * @see doSave()
     */
    protected function doUpdate(ConnectionInterface $con)
    {
        $selectCriteria = $this->buildPkeyCriteria();
        $valuesCriteria = $this->buildCriteria();

        return $selectCriteria->doUpdate($valuesCriteria, $con);
    }

    /**
     * Retrieves a field from the object by name passed in as a string.
     *
     * @param      string $name name
     * @param      string $type The type of fieldname the $name is of:
     *                     one of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                     TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                     Defaults to TableMap::TYPE_PHPNAME.
     * @return mixed Value of field.
     */
    public function getByName($name, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = CareMedProductsMainTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
        $field = $this->getByPosition($pos);

        return $field;
    }

    /**
     * Retrieves a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param      int $pos position in xml schema
     * @return mixed Value of field at $pos
     */
    public function getByPosition($pos)
    {
        switch ($pos) {
            case 0:
                return $this->getBestellnum();
                break;
            case 1:
                return $this->getArtikelnum();
                break;
            case 2:
                return $this->getIndustrynum();
                break;
            case 3:
                return $this->getArtikelname();
                break;
            case 4:
                return $this->getGeneric();
                break;
            case 5:
                return $this->getDescription();
                break;
            case 6:
                return $this->getPacking();
                break;
            case 7:
                return $this->getMinorder();
                break;
            case 8:
                return $this->getMaxorder();
                break;
            case 9:
                return $this->getProorder();
                break;
            case 10:
                return $this->getPicfile();
                break;
            case 11:
                return $this->getEncoder();
                break;
            case 12:
                return $this->getEncDate();
                break;
            case 13:
                return $this->getEncTime();
                break;
            case 14:
                return $this->getLockFlag();
                break;
            case 15:
                return $this->getMedgroup();
                break;
            case 16:
                return $this->getCave();
                break;
            case 17:
                return $this->getStatus();
                break;
            case 18:
                return $this->getHistory();
                break;
            case 19:
                return $this->getModifyId();
                break;
            case 20:
                return $this->getModifyTime();
                break;
            case 21:
                return $this->getCreateId();
                break;
            case 22:
                return $this->getCreateTime();
                break;
            default:
                return null;
                break;
        } // switch()
    }

    /**
     * Exports the object as an array.
     *
     * You can specify the key type of the array by passing one of the class
     * type constants.
     *
     * @param     string  $keyType (optional) One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME,
     *                    TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                    Defaults to TableMap::TYPE_PHPNAME.
     * @param     boolean $includeLazyLoadColumns (optional) Whether to include lazy loaded columns. Defaults to TRUE.
     * @param     array $alreadyDumpedObjects List of objects to skip to avoid recursion
     *
     * @return array an associative array containing the field names (as keys) and field values
     */
    public function toArray($keyType = TableMap::TYPE_PHPNAME, $includeLazyLoadColumns = true, $alreadyDumpedObjects = array())
    {

        if (isset($alreadyDumpedObjects['CareMedProductsMain'][$this->hashCode()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['CareMedProductsMain'][$this->hashCode()] = true;
        $keys = CareMedProductsMainTableMap::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getBestellnum(),
            $keys[1] => $this->getArtikelnum(),
            $keys[2] => $this->getIndustrynum(),
            $keys[3] => $this->getArtikelname(),
            $keys[4] => $this->getGeneric(),
            $keys[5] => $this->getDescription(),
            $keys[6] => $this->getPacking(),
            $keys[7] => $this->getMinorder(),
            $keys[8] => $this->getMaxorder(),
            $keys[9] => $this->getProorder(),
            $keys[10] => $this->getPicfile(),
            $keys[11] => $this->getEncoder(),
            $keys[12] => $this->getEncDate(),
            $keys[13] => $this->getEncTime(),
            $keys[14] => $this->getLockFlag(),
            $keys[15] => $this->getMedgroup(),
            $keys[16] => $this->getCave(),
            $keys[17] => $this->getStatus(),
            $keys[18] => $this->getHistory(),
            $keys[19] => $this->getModifyId(),
            $keys[20] => $this->getModifyTime(),
            $keys[21] => $this->getCreateId(),
            $keys[22] => $this->getCreateTime(),
        );
        if ($result[$keys[20]] instanceof \DateTimeInterface) {
            $result[$keys[20]] = $result[$keys[20]]->format('c');
        }

        if ($result[$keys[22]] instanceof \DateTimeInterface) {
            $result[$keys[22]] = $result[$keys[22]]->format('c');
        }

        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }


        return $result;
    }

    /**
     * Sets a field from the object by name passed in as a string.
     *
     * @param  string $name
     * @param  mixed  $value field value
     * @param  string $type The type of fieldname the $name is of:
     *                one of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                Defaults to TableMap::TYPE_PHPNAME.
     * @return $this|\CareMd\CareMd\CareMedProductsMain
     */
    public function setByName($name, $value, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = CareMedProductsMainTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

        return $this->setByPosition($pos, $value);
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param  int $pos position in xml schema
     * @param  mixed $value field value
     * @return $this|\CareMd\CareMd\CareMedProductsMain
     */
    public function setByPosition($pos, $value)
    {
        switch ($pos) {
            case 0:
                $this->setBestellnum($value);
                break;
            case 1:
                $this->setArtikelnum($value);
                break;
            case 2:
                $this->setIndustrynum($value);
                break;
            case 3:
                $this->setArtikelname($value);
                break;
            case 4:
                $this->setGeneric($value);
                break;
            case 5:
                $this->setDescription($value);
                break;
            case 6:
                $this->setPacking($value);
                break;
            case 7:
                $this->setMinorder($value);
                break;
            case 8:
                $this->setMaxorder($value);
                break;
            case 9:
                $this->setProorder($value);
                break;
            case 10:
                $this->setPicfile($value);
                break;
            case 11:
                $this->setEncoder($value);
                break;
            case 12:
                $this->setEncDate($value);
                break;
            case 13:
                $this->setEncTime($value);
                break;
            case 14:
                $this->setLockFlag($value);
                break;
            case 15:
                $this->setMedgroup($value);
                break;
            case 16:
                $this->setCave($value);
                break;
            case 17:
                $this->setStatus($value);
                break;
            case 18:
                $this->setHistory($value);
                break;
            case 19:
                $this->setModifyId($value);
                break;
            case 20:
                $this->setModifyTime($value);
                break;
            case 21:
                $this->setCreateId($value);
                break;
            case 22:
                $this->setCreateTime($value);
                break;
        } // switch()

        return $this;
    }

    /**
     * Populates the object using an array.
     *
     * This is particularly useful when populating an object from one of the
     * request arrays (e.g. $_POST).  This method goes through the column
     * names, checking to see whether a matching key exists in populated
     * array. If so the setByName() method is called for that column.
     *
     * You can specify the key type of the array by additionally passing one
     * of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME,
     * TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     * The default key type is the column's TableMap::TYPE_PHPNAME.
     *
     * @param      array  $arr     An array to populate the object from.
     * @param      string $keyType The type of keys the array uses.
     * @return void
     */
    public function fromArray($arr, $keyType = TableMap::TYPE_PHPNAME)
    {
        $keys = CareMedProductsMainTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setBestellnum($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setArtikelnum($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setIndustrynum($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setArtikelname($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setGeneric($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setDescription($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setPacking($arr[$keys[6]]);
        }
        if (array_key_exists($keys[7], $arr)) {
            $this->setMinorder($arr[$keys[7]]);
        }
        if (array_key_exists($keys[8], $arr)) {
            $this->setMaxorder($arr[$keys[8]]);
        }
        if (array_key_exists($keys[9], $arr)) {
            $this->setProorder($arr[$keys[9]]);
        }
        if (array_key_exists($keys[10], $arr)) {
            $this->setPicfile($arr[$keys[10]]);
        }
        if (array_key_exists($keys[11], $arr)) {
            $this->setEncoder($arr[$keys[11]]);
        }
        if (array_key_exists($keys[12], $arr)) {
            $this->setEncDate($arr[$keys[12]]);
        }
        if (array_key_exists($keys[13], $arr)) {
            $this->setEncTime($arr[$keys[13]]);
        }
        if (array_key_exists($keys[14], $arr)) {
            $this->setLockFlag($arr[$keys[14]]);
        }
        if (array_key_exists($keys[15], $arr)) {
            $this->setMedgroup($arr[$keys[15]]);
        }
        if (array_key_exists($keys[16], $arr)) {
            $this->setCave($arr[$keys[16]]);
        }
        if (array_key_exists($keys[17], $arr)) {
            $this->setStatus($arr[$keys[17]]);
        }
        if (array_key_exists($keys[18], $arr)) {
            $this->setHistory($arr[$keys[18]]);
        }
        if (array_key_exists($keys[19], $arr)) {
            $this->setModifyId($arr[$keys[19]]);
        }
        if (array_key_exists($keys[20], $arr)) {
            $this->setModifyTime($arr[$keys[20]]);
        }
        if (array_key_exists($keys[21], $arr)) {
            $this->setCreateId($arr[$keys[21]]);
        }
        if (array_key_exists($keys[22], $arr)) {
            $this->setCreateTime($arr[$keys[22]]);
        }
    }

     /**
     * Populate the current object from a string, using a given parser format
     * <code>
     * $book = new Book();
     * $book->importFrom('JSON', '{"Id":9012,"Title":"Don Juan","ISBN":"0140422161","Price":12.99,"PublisherId":1234,"AuthorId":5678}');
     * </code>
     *
     * You can specify the key type of the array by additionally passing one
     * of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME,
     * TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     * The default key type is the column's TableMap::TYPE_PHPNAME.
     *
     * @param mixed $parser A AbstractParser instance,
     *                       or a format name ('XML', 'YAML', 'JSON', 'CSV')
     * @param string $data The source data to import from
     * @param string $keyType The type of keys the array uses.
     *
     * @return $this|\CareMd\CareMd\CareMedProductsMain The current object, for fluid interface
     */
    public function importFrom($parser, $data, $keyType = TableMap::TYPE_PHPNAME)
    {
        if (!$parser instanceof AbstractParser) {
            $parser = AbstractParser::getParser($parser);
        }

        $this->fromArray($parser->toArray($data), $keyType);

        return $this;
    }

    /**
     * Build a Criteria object containing the values of all modified columns in this object.
     *
     * @return Criteria The Criteria object containing all modified values.
     */
    public function buildCriteria()
    {
        $criteria = new Criteria(CareMedProductsMainTableMap::DATABASE_NAME);

        if ($this->isColumnModified(CareMedProductsMainTableMap::COL_BESTELLNUM)) {
            $criteria->add(CareMedProductsMainTableMap::COL_BESTELLNUM, $this->bestellnum);
        }
        if ($this->isColumnModified(CareMedProductsMainTableMap::COL_ARTIKELNUM)) {
            $criteria->add(CareMedProductsMainTableMap::COL_ARTIKELNUM, $this->artikelnum);
        }
        if ($this->isColumnModified(CareMedProductsMainTableMap::COL_INDUSTRYNUM)) {
            $criteria->add(CareMedProductsMainTableMap::COL_INDUSTRYNUM, $this->industrynum);
        }
        if ($this->isColumnModified(CareMedProductsMainTableMap::COL_ARTIKELNAME)) {
            $criteria->add(CareMedProductsMainTableMap::COL_ARTIKELNAME, $this->artikelname);
        }
        if ($this->isColumnModified(CareMedProductsMainTableMap::COL_GENERIC)) {
            $criteria->add(CareMedProductsMainTableMap::COL_GENERIC, $this->generic);
        }
        if ($this->isColumnModified(CareMedProductsMainTableMap::COL_DESCRIPTION)) {
            $criteria->add(CareMedProductsMainTableMap::COL_DESCRIPTION, $this->description);
        }
        if ($this->isColumnModified(CareMedProductsMainTableMap::COL_PACKING)) {
            $criteria->add(CareMedProductsMainTableMap::COL_PACKING, $this->packing);
        }
        if ($this->isColumnModified(CareMedProductsMainTableMap::COL_MINORDER)) {
            $criteria->add(CareMedProductsMainTableMap::COL_MINORDER, $this->minorder);
        }
        if ($this->isColumnModified(CareMedProductsMainTableMap::COL_MAXORDER)) {
            $criteria->add(CareMedProductsMainTableMap::COL_MAXORDER, $this->maxorder);
        }
        if ($this->isColumnModified(CareMedProductsMainTableMap::COL_PROORDER)) {
            $criteria->add(CareMedProductsMainTableMap::COL_PROORDER, $this->proorder);
        }
        if ($this->isColumnModified(CareMedProductsMainTableMap::COL_PICFILE)) {
            $criteria->add(CareMedProductsMainTableMap::COL_PICFILE, $this->picfile);
        }
        if ($this->isColumnModified(CareMedProductsMainTableMap::COL_ENCODER)) {
            $criteria->add(CareMedProductsMainTableMap::COL_ENCODER, $this->encoder);
        }
        if ($this->isColumnModified(CareMedProductsMainTableMap::COL_ENC_DATE)) {
            $criteria->add(CareMedProductsMainTableMap::COL_ENC_DATE, $this->enc_date);
        }
        if ($this->isColumnModified(CareMedProductsMainTableMap::COL_ENC_TIME)) {
            $criteria->add(CareMedProductsMainTableMap::COL_ENC_TIME, $this->enc_time);
        }
        if ($this->isColumnModified(CareMedProductsMainTableMap::COL_LOCK_FLAG)) {
            $criteria->add(CareMedProductsMainTableMap::COL_LOCK_FLAG, $this->lock_flag);
        }
        if ($this->isColumnModified(CareMedProductsMainTableMap::COL_MEDGROUP)) {
            $criteria->add(CareMedProductsMainTableMap::COL_MEDGROUP, $this->medgroup);
        }
        if ($this->isColumnModified(CareMedProductsMainTableMap::COL_CAVE)) {
            $criteria->add(CareMedProductsMainTableMap::COL_CAVE, $this->cave);
        }
        if ($this->isColumnModified(CareMedProductsMainTableMap::COL_STATUS)) {
            $criteria->add(CareMedProductsMainTableMap::COL_STATUS, $this->status);
        }
        if ($this->isColumnModified(CareMedProductsMainTableMap::COL_HISTORY)) {
            $criteria->add(CareMedProductsMainTableMap::COL_HISTORY, $this->history);
        }
        if ($this->isColumnModified(CareMedProductsMainTableMap::COL_MODIFY_ID)) {
            $criteria->add(CareMedProductsMainTableMap::COL_MODIFY_ID, $this->modify_id);
        }
        if ($this->isColumnModified(CareMedProductsMainTableMap::COL_MODIFY_TIME)) {
            $criteria->add(CareMedProductsMainTableMap::COL_MODIFY_TIME, $this->modify_time);
        }
        if ($this->isColumnModified(CareMedProductsMainTableMap::COL_CREATE_ID)) {
            $criteria->add(CareMedProductsMainTableMap::COL_CREATE_ID, $this->create_id);
        }
        if ($this->isColumnModified(CareMedProductsMainTableMap::COL_CREATE_TIME)) {
            $criteria->add(CareMedProductsMainTableMap::COL_CREATE_TIME, $this->create_time);
        }

        return $criteria;
    }

    /**
     * Builds a Criteria object containing the primary key for this object.
     *
     * Unlike buildCriteria() this method includes the primary key values regardless
     * of whether or not they have been modified.
     *
     * @throws LogicException if no primary key is defined
     *
     * @return Criteria The Criteria object containing value(s) for primary key(s).
     */
    public function buildPkeyCriteria()
    {
        $criteria = ChildCareMedProductsMainQuery::create();
        $criteria->add(CareMedProductsMainTableMap::COL_BESTELLNUM, $this->bestellnum);

        return $criteria;
    }

    /**
     * If the primary key is not null, return the hashcode of the
     * primary key. Otherwise, return the hash code of the object.
     *
     * @return int Hashcode
     */
    public function hashCode()
    {
        $validPk = null !== $this->getBestellnum();

        $validPrimaryKeyFKs = 0;
        $primaryKeyFKs = [];

        if ($validPk) {
            return crc32(json_encode($this->getPrimaryKey(), JSON_UNESCAPED_UNICODE));
        } elseif ($validPrimaryKeyFKs) {
            return crc32(json_encode($primaryKeyFKs, JSON_UNESCAPED_UNICODE));
        }

        return spl_object_hash($this);
    }

    /**
     * Returns the primary key for this object (row).
     * @return string
     */
    public function getPrimaryKey()
    {
        return $this->getBestellnum();
    }

    /**
     * Generic method to set the primary key (bestellnum column).
     *
     * @param       string $key Primary key.
     * @return void
     */
    public function setPrimaryKey($key)
    {
        $this->setBestellnum($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     * @return boolean
     */
    public function isPrimaryKeyNull()
    {
        return null === $this->getBestellnum();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param      object $copyObj An object of \CareMd\CareMd\CareMedProductsMain (or compatible) type.
     * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setBestellnum($this->getBestellnum());
        $copyObj->setArtikelnum($this->getArtikelnum());
        $copyObj->setIndustrynum($this->getIndustrynum());
        $copyObj->setArtikelname($this->getArtikelname());
        $copyObj->setGeneric($this->getGeneric());
        $copyObj->setDescription($this->getDescription());
        $copyObj->setPacking($this->getPacking());
        $copyObj->setMinorder($this->getMinorder());
        $copyObj->setMaxorder($this->getMaxorder());
        $copyObj->setProorder($this->getProorder());
        $copyObj->setPicfile($this->getPicfile());
        $copyObj->setEncoder($this->getEncoder());
        $copyObj->setEncDate($this->getEncDate());
        $copyObj->setEncTime($this->getEncTime());
        $copyObj->setLockFlag($this->getLockFlag());
        $copyObj->setMedgroup($this->getMedgroup());
        $copyObj->setCave($this->getCave());
        $copyObj->setStatus($this->getStatus());
        $copyObj->setHistory($this->getHistory());
        $copyObj->setModifyId($this->getModifyId());
        $copyObj->setModifyTime($this->getModifyTime());
        $copyObj->setCreateId($this->getCreateId());
        $copyObj->setCreateTime($this->getCreateTime());
        if ($makeNew) {
            $copyObj->setNew(true);
        }
    }

    /**
     * Makes a copy of this object that will be inserted as a new row in table when saved.
     * It creates a new object filling in the simple attributes, but skipping any primary
     * keys that are defined for the table.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param  boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @return \CareMd\CareMd\CareMedProductsMain Clone of current object.
     * @throws PropelException
     */
    public function copy($deepCopy = false)
    {
        // we use get_class(), because this might be a subclass
        $clazz = get_class($this);
        $copyObj = new $clazz();
        $this->copyInto($copyObj, $deepCopy);

        return $copyObj;
    }

    /**
     * Clears the current object, sets all attributes to their default values and removes
     * outgoing references as well as back-references (from other objects to this one. Results probably in a database
     * change of those foreign objects when you call `save` there).
     */
    public function clear()
    {
        $this->bestellnum = null;
        $this->artikelnum = null;
        $this->industrynum = null;
        $this->artikelname = null;
        $this->generic = null;
        $this->description = null;
        $this->packing = null;
        $this->minorder = null;
        $this->maxorder = null;
        $this->proorder = null;
        $this->picfile = null;
        $this->encoder = null;
        $this->enc_date = null;
        $this->enc_time = null;
        $this->lock_flag = null;
        $this->medgroup = null;
        $this->cave = null;
        $this->status = null;
        $this->history = null;
        $this->modify_id = null;
        $this->modify_time = null;
        $this->create_id = null;
        $this->create_time = null;
        $this->alreadyInSave = false;
        $this->clearAllReferences();
        $this->applyDefaultValues();
        $this->resetModified();
        $this->setNew(true);
        $this->setDeleted(false);
    }

    /**
     * Resets all references and back-references to other model objects or collections of model objects.
     *
     * This method is used to reset all php object references (not the actual reference in the database).
     * Necessary for object serialisation.
     *
     * @param      boolean $deep Whether to also clear the references on all referrer objects.
     */
    public function clearAllReferences($deep = false)
    {
        if ($deep) {
        } // if ($deep)

    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(CareMedProductsMainTableMap::DEFAULT_STRING_FORMAT);
    }

    /**
     * Code to be run before persisting the object
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preSave(ConnectionInterface $con = null)
    {
        if (is_callable('parent::preSave')) {
            return parent::preSave($con);
        }
        return true;
    }

    /**
     * Code to be run after persisting the object
     * @param ConnectionInterface $con
     */
    public function postSave(ConnectionInterface $con = null)
    {
        if (is_callable('parent::postSave')) {
            parent::postSave($con);
        }
    }

    /**
     * Code to be run before inserting to database
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preInsert(ConnectionInterface $con = null)
    {
        if (is_callable('parent::preInsert')) {
            return parent::preInsert($con);
        }
        return true;
    }

    /**
     * Code to be run after inserting to database
     * @param ConnectionInterface $con
     */
    public function postInsert(ConnectionInterface $con = null)
    {
        if (is_callable('parent::postInsert')) {
            parent::postInsert($con);
        }
    }

    /**
     * Code to be run before updating the object in database
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preUpdate(ConnectionInterface $con = null)
    {
        if (is_callable('parent::preUpdate')) {
            return parent::preUpdate($con);
        }
        return true;
    }

    /**
     * Code to be run after updating the object in database
     * @param ConnectionInterface $con
     */
    public function postUpdate(ConnectionInterface $con = null)
    {
        if (is_callable('parent::postUpdate')) {
            parent::postUpdate($con);
        }
    }

    /**
     * Code to be run before deleting the object in database
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preDelete(ConnectionInterface $con = null)
    {
        if (is_callable('parent::preDelete')) {
            return parent::preDelete($con);
        }
        return true;
    }

    /**
     * Code to be run after deleting the object in database
     * @param ConnectionInterface $con
     */
    public function postDelete(ConnectionInterface $con = null)
    {
        if (is_callable('parent::postDelete')) {
            parent::postDelete($con);
        }
    }


    /**
     * Derived method to catches calls to undefined methods.
     *
     * Provides magic import/export method support (fromXML()/toXML(), fromYAML()/toYAML(), etc.).
     * Allows to define default __call() behavior if you overwrite __call()
     *
     * @param string $name
     * @param mixed  $params
     *
     * @return array|string
     */
    public function __call($name, $params)
    {
        if (0 === strpos($name, 'get')) {
            $virtualColumn = substr($name, 3);
            if ($this->hasVirtualColumn($virtualColumn)) {
                return $this->getVirtualColumn($virtualColumn);
            }

            $virtualColumn = lcfirst($virtualColumn);
            if ($this->hasVirtualColumn($virtualColumn)) {
                return $this->getVirtualColumn($virtualColumn);
            }
        }

        if (0 === strpos($name, 'from')) {
            $format = substr($name, 4);

            return $this->importFrom($format, reset($params));
        }

        if (0 === strpos($name, 'to')) {
            $format = substr($name, 2);
            $includeLazyLoadColumns = isset($params[0]) ? $params[0] : true;

            return $this->exportTo($format, $includeLazyLoadColumns);
        }

        throw new BadMethodCallException(sprintf('Call to undefined method: %s.', $name));
    }

}
