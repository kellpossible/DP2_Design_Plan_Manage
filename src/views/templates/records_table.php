<?php
/** Display a table of records */
abstract class RecordsTable
{
	/** Get an array of html column headings */
	abstract protected getHTMLColumnHeadings();

	/** returns an array of html representations of variables belonging to an item/row in the table */
	abstract protected getHTMLItemRow($row_index);

	/** Get the number of items/rows in this table */
	abstract protected getCountItemRows();
}
?>