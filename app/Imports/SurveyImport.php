<?php

namespace App\Imports;

use App\Models\Question;
use App\Models\QuestionOption;
use App\Models\SurveySection;
use Auth;
use DB;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithStartRow;

class SurveyImport implements ToCollection, WithStartRow
{

    public function __construct($survey_id)
    {
        $this->survey_id = $survey_id;
    }

    /**
     * @param Collection $collection
     */
    public function collection(Collection $rows)
    {
        $current_section = null;
        $current_question = null;

        DB::beginTransaction();
        try {
            foreach ($rows as $row) {
                if ($row[0] === 'cau_tra_loi' && $current_question) {
                    $current_option = QuestionOption::create([
                        'question_id' => $current_question->id,
                        'score' => $row[2],
                        'content' => $row[1],
                    ]);
                    $current_option->order = $current_option->id;
                    $current_option->save();
                };

                if ($row[0] === 'cau_tra_loi_khac' && $current_question) {
                    $current_question->can_comment = 1;
                    $current_question->save();
                };

                if ($row[0] === 'cau_hoi' && $current_section) {
                    $current_question = Question::create([
                        'content' => $row[1],
                        'created_by' => Auth::user()->id,
                    ]);
                    $current_question->order = $current_question->id;
                    $current_question->save();
                    DB::table('survey_section_has_questions')->insert([
                        'survey_section_id' => $current_section->id,
                        'question_id' => $current_question->id,
                    ]);
                };

                if ($row[0] === 'cau_hoi_bat_buoc' && $current_section) {
                    $current_question = Question::create([
                        'content' => $row[1],
                        'create_by' => Auth::user()->id,
                        'must_mark' => 1,
                    ]);
                    $current_question->order = $current_question->id;
                    $current_question->save();
                    DB::table('survey_section_has_questions')->insert([
                        'survey_section_id' => $current_section->id,
                        'question_id' => $current_question->id,
                    ]);
                };

                if ($row[0] === 'section') {
                    $current_section = SurveySection::create([
                        'survey_id' => $this->survey_id,
                        'title' => $row[1],
                        'content' => $row[2],
                    ]);
                    $current_section->order = $current_section->id;
                    $current_section->save();
                };
            }
            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
            return null;
        }

    }

    /**
     * @return int
     */
    public function startRow(): int
    {
        return 2;
    }

}