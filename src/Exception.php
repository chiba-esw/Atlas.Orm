<?php
/**
 *
 * This file is part of Atlas for PHP.
 *
 * @license http://opensource.org/licenses/MIT MIT
 *
 */
namespace Atlas\Orm;

/**
 *
 * Base exception class, with factory methods.
 *
 * @package atlas/orm
 *
 */
class Exception extends \Exception
{
    /**
     *
     * A class does not exist.
     *
     * @param string $class The class name.
     *
     * @return Exception
     *
     */
    public static function classDoesNotExist($class)
    {
        return new Exception("{$class} does not exist.");
    }

    /**
     *
     * Tried to execute an entire transaction twice.
     *
     * @return Exception
     *
     */
    public static function priorTransaction()
    {
        return new Exception("Cannot re-execute a prior transaction.");
    }

    /**
     *
     * Tried to execute work in a transaction twice.
     *
     * @return Exception
     *
     */
    public static function priorWork()
    {
        return new Exception("Cannot re-invoke prior work.");
    }

    /**
     *
     * A class property does not exist.
     *
     * @param string $class The class name.
     *
     * @param string $property The property name.
     *
     * @return Exception
     *
     */
    public static function propertyDoesNotExist($class, $property)
    {
        if (is_object($class)) {
            $class = get_class($class);
        }
        return new Exception("{$class}::\${$property} does not exist.");
    }

    /**
     *
     * A mapper class is not in the locator.
     *
     * @param string $class The mapper class name.
     *
     * @return Exception
     *
     */
    public static function mapperNotFound($class)
    {
        return new Exception("{$class} not found in mapper locator.");
    }

    /**
     *
     * A table class is not in the locator.
     *
     * @param string $class The table class name.
     *
     * @return Exception
     *
     */
    public static function tableNotFound($class)
    {
        return new Exception("{$class} not found in table locator.");
    }

    /**
     *
     * A parameter or argument was of an invalid type.
     *
     * @param string $expect The expected type.
     *
     * @param mixed $actual The actual parameter or argument.
     *
     * @return Exception
     *
     */
    public static function invalidType($expect, $actual)
    {
        if (is_object($actual)) {
            $actual = get_class($actual);
        } else {
            $actual = gettype($actual);
        }

        return new Exception("Expected type $expect; got $actual instead.");
    }

    /**
     *
     * A row does not exist in the identity map.
     *
     * @return Exception
     *
     */
    public static function rowNotMapped()
    {
        return new Exception("Row does not exist in IdentityMap.");
    }

    /**
     *
     * A row already exists in the identity map.
     *
     * @return Exception
     *
     */
    public static function rowAlreadyMapped()
    {
        return new Exception("Row already exists in IdentityMap.");
    }

    /**
     *
     * A relationship is not defined.
     *
     * @param string $foreignName The foreign relationship name.
     *
     * @return Exception
     *
     */
    public static function relationshipDoesNotExist($foreignName)
    {
        return new Exception("Relationship '$foreignName' does not exist.");
    }

    /**
     *
     * The "through" relationshp for a many-to-many has not been fetched.
     *
     * @param string $foreignName The "foreign" relationship name.
     *
     * @param string $throughName The "through" relationship name.
     *
     * @return Exception
     *
     */
    public static function throughRelationshipNotFetched($foreignName, $throughName)
    {
        return new Exception("Cannot fetch '{$foreignName}' relationship without '{$throughName}' relationship.");
    }

    /**
     *
     * A query affected number of table rows other than 1.
     *
     * @param int $count The actual number of rows affected.
     *
     * @return Exception
     *
     */
    public static function unexpectedRowCountAffected($count)
    {
        return new Exception("Expected 1 row affected, actual {$count}.");
    }

    /**
     *
     * An object property cannot be modified after it has been deleted.
     *
     * @param object|string $class The row object, or the class name.
     *
     * @param string $property The property being modified.
     *
     * @return Exception
     *
     */
    public static function immutableOnceDeleted($class, $property)
    {
        if (is_object($class)) {
            $class = get_class($class);
        }
        return new Exception("{$class}::\${$property} is immutable once deleted.");
    }

    /**
     *
     * A row status is invalid.
     *
     * @param string $status The invalid status.
     *
     * @return Exception
     *
     */
    public static function invalidStatus($status)
    {
        return new Exception("Expected valid row status, got '$status' instead.");
    }

    /**
     *
     * Expected a scalar primary value.
     *
     * @param string $col The primary column name.
     *
     * @param string $val The unexpected value received as the primary.
     *
     * @return Exception
     *
     */
    public static function primaryValueNotScalar($col, $val)
    {
        $message = "Expected scalar value for primary key '{$col}', "
            . "got " . gettype($val) . " instead.";
        return new Exception($message);
    }

    /**
     *
     * A primary key value is missing.
     *
     * @param string $col The column on which the value is missing.
     *
     * @return Exception
     *
     */
    public static function primaryValueMissing($col)
    {
        $message = "Expected scalar value for primary key '$col', "
            . "value is missing instead.";
        return new Exception($message);
    }

    /**
     *
     * Expected an array for a primary key value.
     *
     * @param mixed $val The unexpected value received as the primary.
     *
     * @return Exception
     *
     */
    public static function primaryKeyNotArray($val)
    {
        $message = "Expected array for composite primary key, "
            . "got " . gettype($val) . " instead.";
        return new Exception($message);
    }

    /**
     *
     * Expected a string column name (not a number or numeric string).
     *
     * @param mixed $col The unexpected column name.
     *
     * @return Exception
     *
     */
    public static function numericCol($col)
    {
        $message = "Expected non-numeric column name, got '$col' instead.";
        return new Exception($message);
    }

    public static function relatedNameConflict($name)
    {
        $message = "Relationship '$name' conflicts with existing column name.";
        return new Exception($message);
    }
}
