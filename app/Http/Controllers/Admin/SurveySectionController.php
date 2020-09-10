<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Question;
use App\Models\SurveySection;
use Auth;
use DB;
use Illuminate\Http\Request;

class SurveySectionController extends Controller
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
            $new_section = SurveySection::create($request->all());
            $new_question = Question::create([
                'content' => null,
                'created_by' => Auth::user()->id,
            ]);
            DB::table('survey_section_has_questions')->insert([
                'survey_section_id' => $new_section->id,
                'question_id' => $new_question->id,
            ]);
            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
            throw new Exception($e->getMessage());
        }

        return ['msg' => 'Tạo mới section thành công', 'newSection' => $new_section->id, 'newQuestion' => $new_question->id];

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
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        if ($request->has('section_id')) {
            $section = SurveySection::findOrFail($request->section_id);
        } else {
            return ['error' => 'Không tìm thấy section'];
        }

        if ($request->has('title')) {
            $section->update(['title' => $request->title]);
        }

        if ($request->has('content')) {
            $section->update(['content' => $request->content]);
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
        if ($request->has('section_id')) {
            $section = SurveySection::findOrFail($request->section_id);
        } else {
            return ['error' => 'Không tìm thấy section'];
        }
        $section->delete();
        return ['msg' => 'Xóa thành công section'];

    }

}