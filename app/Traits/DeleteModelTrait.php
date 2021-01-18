<?php 
    namespace app\Traits;
    use Log;

    trait deleteModelTrait {
        public function deleteModelTrait($id, $model){
            try {
                $model->find($id)->delete();
                return response()->json([
                    'code' => 200,
                    'message' => 'success'
                ]);
    
            } catch(\Exception $e) {
                Log::error('Error: ' . $e->getMessage() .'----line: '.$e->getLine(). ' ---File: '.$e->getFile());
                return response()->json([
                    'code' => 500,
                    'message' => 'fail'
                ]);
            }
        }
    }