<?php

namespace App\Http\Controllers;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
   
    public function index()
    {
        
        return Task::all();
    }

   
    public function store(Request $request)
    {
       // return $request->all();
        $request->validate([
            'taskname'=>'required|string',
            'taskdescription'=>'required|string',
            'completion_date'=>'required|date',
            ]);
           
            try{
                //return $request->all();
                Task::firstOrCreate($request->all());
                return "Task has been created sucessfully";
    
            }
            catch(\Exception $e){
               
                return  response()->json(['error' => "The form submission was not successful"], 401);
            }
      
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Task::findorFail($id);
    }

   
     public function update(Request $request, $id)
     {
         $task=Task::findorFail($id);
         $task->update($request->all());
         return $task;
     }

     //public function destroy(Task $Task)
     public function destroy($id)
     {
         try {
             $task =Task::findorFail($id)->delete();
             return  response()->json(['success' => "The task has been successfully deleted"], 201);
         } catch(Exception $e) {
            return  response()->json(['error' => "The task deletion was not successful"], 401);
         }
     }
}
