<?php
namespace App\Model\Servicies;
use Maatwebsite\Excel\Excel;

class ExcelImport extends Excel
{

    protected $orm = null;
    protected $dataFillable=[];
    protected $countFillable=3;
    private $status = true;

    public function setOrm($orm){
        $this->orm= new $orm;
        $this->dataFillable= $this->orm->getFillable();
        $this->countFillable=count($this->dataFillable);
    }

    public function import($filePath)
    {
        $this->read($filePath);
        echo $this->getResult();
    }

    protected function getResult()
    {
        if( $this->status ){
            return 'ok';
        }
        return 'fail';
    }

	protected function hasReadRowToDoSomething($rowData)
    {
        $OrmCreateData = [];
        foreach( $this->dataFillable as $key => $value ) {
            $OrmCreateData[$value] = $rowData[$key];
        }
        echo 'write...'.implode($OrmCreateData,',   ')."\n</br>";
        $this->orm->create($OrmCreateData);
	}
    private function read($filePath)
    {
        $this->load($filePath,function($reader){
            $reader->noHeading();
            $this->readSheet($reader);
        });
    }
    private function readSheet($reader){
        $reader->each( function ($sheet) {
            if( !$this->status ) {
                return false;
            }
            if($this->countFillable != $sheet->count() ) {
                $this->status=false;
                return false;
            }
            $this->readRow($sheet);
        });
    }
    private function readRow($sheet)
    {
        $rowData=[];

        $sheet->each(function ($row) use (&$rowData) {
            array_push($rowData, $row);
        });

        $this->hasReadRowToDoSomething($rowData);
    }

}

