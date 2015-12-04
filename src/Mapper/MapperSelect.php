<?php
namespace Atlas\Orm\Mapper;

use Atlas\Orm\Table\TableSelect;

class MapperSelect
{
    protected $with = [];

    protected $tableSelect;

    public function __construct(Mapper $mapper, TableSelect $tableSelect)
    {
        $this->mapper = $mapper; // convertRow(), convertRowSet()
        $this->tableSelect = $tableSelect;
    }

    public function __call($method, $params)
    {
        $result = call_user_func_array([$this->tableSelect, $method], $params);
        return ($result === $this->tableSelect) ? $this : $result;
    }

    public function with(array $with)
    {
        $this->with = $with;
        return $this;
    }

    public function getTableSelect()
    {
        return $this->tableSelect;
    }

    public function fetchRecord()
    {
        $row = $this->tableSelect->fetchRow();
        if (! $row) {
            return false;
        }
        return $this->mapper->convertRow($row, $this->with);
    }

    public function fetchRecordSet()
    {
        $rowSet = $this->tableSelect->fetchRowSet();
        if (! $rowSet) {
            return array();
        }
        return $this->mapper->convertRowSet($rowSet, $this->with);
    }
}
