<?php

/**
 * Created by PhpStorm.
 * User: jongking
 * Date: 2014/12/30
 * Time: 22:13
 */
class Install
{

    public function init()
    {

    }

    public function createTableMsgV()
    {
        $sql = 'CREATE VIEW [dbo].[TableMsgV] AS' +
            'SELECT   sys.syscolumns.name, sys.syscolumns.id, sys.syscolumns.xtype, sys.syscolumns.length, sys.syscolumns.isnullable,' +
            'sys.systypes.name AS typename ' +
            'FROM sys.syscolumns INNER JOIN ' +
            'sys.systypes ON sys.syscolumns.xtype = sys.systypes.xtype';
        return $sql;
    }

}