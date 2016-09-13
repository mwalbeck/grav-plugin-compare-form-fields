# Compare Form Fields Plugin

The **Compare Form Fields** Plugin is for [Grav CMS](http://github.com/getgrav/grav).

## Description

This plugin can compare any 2 fields in a form. Currently you can only compare 1 set of fields per form as that was all i needed.

To compare 2 fields you just add the **compare_fields** option in the process section of the form. After that you add the name property of the 2 fields to "field1" and "field2" options under **compare_fields**. Example below:

    process:
      compare_fields:
        field1: "name of first field"
        field2: "name of second field"

This plugin is licensed under The MIT license.