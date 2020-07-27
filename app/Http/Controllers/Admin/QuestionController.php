<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Question;
use Auth;
use DB;
use Illuminate\Http\Request;

class QuestionController extends Controller
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
            $new_question = Question::create([
                'content' => null,
                'created_by' => Auth::user()->id,
            ]);
            DB::table('survey_section_has_questions')->insert([
                'survey_section_id' => $request->section_id,
                'question_id' => $new_question->id,
            ]);
            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
            throw new Exception($e->getMessage());
        }

        return ['msg' => 'Tạo mới câu hỏi thành công', 'newQuestion' => $new_question->id];
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
        if ($request->has('question_id')) {
            $question = Question::findOrFail($request->question_id);
        } else {
            return ['error' => 'Không tìm thấy Câu hỏi'];
        }

        if ($request->has('content')) {
            if ($request->content) {
                $question->update(['content' => $request->content]);
            }
        }
        return ['msg' => 'Cập nhật thành công'];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
    }
}