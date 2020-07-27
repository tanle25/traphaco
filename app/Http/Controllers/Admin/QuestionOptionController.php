<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\QuestionOption;
use DB;
use Illuminate\Http\Request;

class QuestionOptionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $new_option = QuestionOption::create([
                'content' => null,
                'question_id' => $request->question_id,
                'score' => null,
            ]);
            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
            throw new Exception($e->getMessage());
        }

        return ['msg' => 'Tạo mới câu trả lời thành công', 'newOption' => $new_option->id];
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        if ($request->has('option_id')) {
            $section = QuestionOption::findOrFail($request->option_id);
        } else {
            return ['error' => 'Không tìm thấy option'];
        }

        if ($request->has('content')) {
            if ($request->content) {
                $section->update(['content' => $request->content]);
            }
        }

        if ($request->has('score')) {
            if ($request->score) {
                $section->update(['score' => $request->score]);
            }
        }

        return ['msg' => 'Cập nhật thành công'];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        if ($request->has('option_id')) {
            $question = QuestionOption::findOrFail($request->option_id);
        } else {
            return ['error' => 'Không tìm thấy câu trả lời!'];
        }
        $question->delete();
        return ['msg' => 'Xóa thành công câu trả lời'];
    }
}