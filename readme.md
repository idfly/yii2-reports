yii2-reports
=====================

The module for exports data from MySql in formats csv/json/xml.
Note: the module works in common with the idfly admin-panel.

## Set

1. To the project file `composer.json` add to the `require` section:

      `"idfly/yii2-reports": "dev-master"`

2. To the `repositories` section:
      ```
      {
           "type": "git",
           "url": "git@bitbucket.org:idfly/reports.git"
      }
      ```

3. Run `composer update`

4. Set routing in the project's configuration file:

```
'api/reports/<secret:\w+>' => 'reports/export',
'admin/reports' => 'reports/reports',
'admin/reports/<action>' => 'reports/reports/<action>',
```

5. Include module in the project's configuration file:

```
$config['modules']['reports'] = ['class' => 'idfly\reports\Module'];
```

Migrations executing with indicating the module path:

```
﻿./yii migrate --migrationPath=@vendor/idfly/yii2-reports/migrations
```


Description
---------

The module has the ability to upload data in formats: csv, json, xml.
To create a report you must indicate sql-query and the format, in which is 
necessary to do data export to the file. 

A feature of the module is an opportunity of turning into sql-query 
GET-parameters.

For example, for setting parameters to the query:
```
SELECT * FROM `ware` LIMIT :limit WHERE `category_id` = :category_id
```
It is necessary to pass in `$_GET['args']` parameters `:limit` and 
`:category_id` as follows: 

```
http://localhost/api/reports/$reportSecret/?args[:limit]=100&args[:category_id]=5
```

where `$reportSecret` - is a secret code of the report indicated in DB.


### Export to .csv:

 - there is an opportunity to indicate csv-delimiter (',', ';', '\t')
 - there is an opportunity to indicate csv-enclosures for the fields (", ', 
 NULL)

Example:

```
SELECT * FROM `ware`
```
Result file .csv:

```
id;category_id;name;description;type
1;2;'ware1';;ware1_desc
2;2;'ware2';;ware2_desc
3;3;'ware3';;ware3_desc
```


### Export to .json:

Example:

```
SELECT * FROM `ware`
```

Result file .json:

```
[
    {"id":"1","category_id":"2","name":"ware1","description":"",
    "type":"material"},
    {"id":"2","category_id":"2","name":"ware2","description":"",
    "type":"material"},
    {"id":"3","category_id":"3","name":"ware3","description":"",
    "type":"material"}
]
```

### Export to .xml:

Example:

```
SELECT * FROM `ware`
```

Result file .xml:

```
<?xml version="1.0" encoding="UTF-8"?>
<elements>
    <element>
    	<id>1</id>
    	<category_id>2</category_id>
    	<name>ware1</name>
    	<description></description>
    	<type>material</type>
    </element>
    <element>
    	<id>2</id>
    	<category_id>2</category_id>
    	<name>ware2</name>
    	<description></description>
    	<type>material</type>
    </element>
    <element>
    	<id>3</id>
    	<category_id>3</category_id>
    	<name>ware3</name>
    	<description></description>
    	<type>material</type>
    </element>
</elements>
```