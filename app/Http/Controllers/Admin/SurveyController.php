<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Survey\CreateSurveyRequest;
use App\Http\Requests\Admin\Survey\UpdateSurveyRequest;
use App\Models\Question;
use App\Models\Survey;
use App\Models\SurveySection;
use Auth;
use DataTables;
use DB;
use Illuminate\Http\Request;

class SurveyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.pages.survey.list');
    }

    public function listSurvey(Request $request)
    {
        $survey = Survey::query()->orderByDesc('id');
        if (Auth::user()->cannot('quản_lý tất cả đề thi')) {
            $survey = $survey->where('created_by', Auth::user()->id);
        }
        // Using datatable dependency
        // Đoạn code này dùng để setup dữ liệu data table
        // Link tham khảo: https://yajrabox.com/docs/laravel-datatables/master/filter-column
        {
            return DataTables::eloquent($survey)
                ->addIndexColumn()
                ->addColumn('action', function ($survey) {
                    return '<a data-toggle-for="tooltip" title="Sửa thông tin" href="' . route('admin.survey.edit', $survey->id) . '"class="btn text-success edit-survey-btn"><i class="fas fa-edit"></i></a>
                        <span data-toggle-for="tooltip" title="Xóa" href="' . route('admin.survey.destroy', $survey->id) . '" class="btn text-danger remove-survey-btn"><i class="far fa-trash-alt"></i></span>';
                })
                ->addColumn('created_by', function ($survey) {
                    if ($survey->author) {
                        return $survey->author->fullname ?? '';
                    }
                    return null;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.survey.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateSurveyRequest $request)
    {
        DB::beginTransaction();
        try {
            $survey = Survey::create($request->all());
            $new_section = SurveySection::create([
                'survey_id' => $survey->id,
                'content' => null,
            ]);

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
            DB::rollBack();
            throw new Exception($e->getMessage());
        }

        return ['request' => $request->all(), 'msg' => 'Tạo mới thành công', 'newSurvey' => $survey->id, 'editUrl' => route('admin.survey.edit', $survey->id)];
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
        $survey = Survey::findOrFail($id);
        return view('admin.pages.survey.edit', compact('survey'));
    }

    /**
     *
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSurveyRequest $request, $id)
    {
        $survey = Survey::findOrFail($id);
        $survey->update($request->all());
        return ['msg' => 'Cập nhật thành công'];

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Survey::findOrFail($id)->delete();
        return ['msg' => 'Xóa thành công'];
    }

}