<?php
namespace App\Http\Drives\storage;

class Alioss
{

    protected  $bucket           = '';
    protected  $resource         = '';
	protected  $AccessKeyId      = '';
    protected  $AccessKeySecret  = '';
    protected  $endpoint         = '';



    /**
     * 上传文件
     * 
     * @param string  $file_path     [文件本地地址]
     * @param string  $file_name     [上传文件名]
     * @param string  $dir_name      [上传目录名称]
     */

    public function upload($file_path, $name, $dir_name='common')
    {
        $object =   $dir_name.'/'.$name;

        try{

            $ossClient = new OssClient($this->AccessKeyId, $this->AccessKeySecret, $this->endpoint);

            $ossClient->uploadFile($this->bucket, $object, $file_path);

        } catch(OssException $e) {

        	throw new \Exception($e->getMessage(), 500);
        }

        $url = $this->resource.'/'.$object;

        return array('status'=>1,'msg'=>'上传成功','data'=>$url);

    }



    /**
     * 存储列表
     * 
     * @return array  [返回存储空间列表]
     */

    public  function lists()
    {

        try{

            $ossClient = new OssClient($this->AccessKeyId, $this->AccessKeySecret, $this->endpoint);

            $bucketListInfo = $ossClient->listBuckets();

        } catch(OssException $e) {

            throw new \Exception($e->getMessage(), 500);
        }

        $bucketList = $bucketListInfo->getBucketList();

        $data = [];

        foreach($bucketList as $bucket) {

            $data = $bucket->getLocation() . "\t" . $bucket->getName() . "\t" . $bucket->getCreatedate() . "\n";
        }

        return array('status'=>1, 'msg'=>'获取成功','data'=>$data);
    }



    /**
     * 删除存储空间
     * 
     * @param  string $object [存储空间名]
     */

    public function delete($object)
    {

        try{

            $ossClient = new OssClient($this->AccessKeyId, $this->AccessKeySecret, $this->endpoint);

            $ossClient->deleteObject($this->bucket, $object);

        } catch(OssException $e) {

           return array('status'=>0,'msg'=>'删除失败','data'=>$e->getMessage());
        }

        return array('status'=>1,'msg'=>'删除成功');    
    }


    /**
     *  文件列表
     * 
     * @param string $value [description]
     */

    public static function files()
    {

        $ossClient = new OssClient(self::$AccessKeyId, self::$AccessKeySecret, self::$endpoint);

        $prefix = 'activity/';
        $delimiter = '';
        $nextMarker = '';
        $maxkeys = '';
        $options = array(

            'delimiter' => $delimiter,

            'prefix' => $prefix,

            'max-keys' => $maxkeys,

            'marker' => $nextMarker,

        );


        while (true) {

            try {

                $listObjectInfo = $ossClient->listObjects(self::$bucket, $options);

            } catch (OssException $e) {

                printf(__FUNCTION__ . ": FAILED\n");

                printf($e->getMessage() . "\n");

                return;
            }

            $nextMarker = $listObjectInfo->getNextMarker();
            $listObject = $listObjectInfo->getObjectList();
            $listPrefix = $listObjectInfo->getPrefixList();

            if (!empty($listObject)) {

                print("objectList:\n");

                foreach ($listObject as $objectInfo) {

                    print($objectInfo->getKey() . "\n");

                }

            }

            if (!empty($listPrefix)) {

                print("prefixList: \n");

                foreach ($listPrefix as $prefixInfo) {

                    print($prefixInfo->getPrefix() . "\n");

                }

            }

            if ($nextMarker === '') {

                break;

            }

        }

    }





    /*
    
     * 查看某个目录的文件

     */

    public function dirnameList($dir)

    {

       

        $ossClient = new OssClient(self::$AccessKeyId, self::$AccessKeySecret, self::$endpoint);



        $prefix = "{$dir}/";

        $delimiter = '/';

        $nextMarker = '';

        $maxkeys = 1000;

        $options = array(

            'delimiter' => $delimiter,
            'prefix' => $prefix,
            'max-keys' => $maxkeys,
            'marker' => $nextMarker,
        );

        try {

            $listObjectInfo = $ossClient->listObjects(self::$bucket, $options);

        } catch (OssException $e) {

            printf(__FUNCTION__ . ": FAILED\n");

            printf($e->getMessage() . "\n");

            return;

        }   

        $data = [];

        $objectList = $listObjectInfo->getObjectList(); // object list

        $prefixList = $listObjectInfo->getPrefixList(); // directory list

        if (!empty($objectList)) {

            foreach ($objectList as $objectInfo) {

               $data['object'][] =  $objectInfo->getKey();
            }
        }

        if (!empty($prefixList)) {

            foreach ($prefixList as $prefixInfo) {

                $data['prefix'][] =  $prefixInfo->getPrefix();
            }
        }

        if($data){
            return array('status'=>1,'data'=>$data['object']);
        }

        return array('status'=>0,'data'=>null);

    }



	
}