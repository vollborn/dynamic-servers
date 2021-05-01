<?php

namespace App\Http\Controllers\Api\Question;

use App\Http\Controllers\Controller;
use App\Http\Resources\QuestionResource;
use App\Models\Question;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;

class QuestionController extends Controller
{
    /**
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        $data = request()->validate([
            'search' => 'nullable|string',
            'page'   => 'required|int'
        ]);

        $query = Question::where('is_visible', true);
        $this->applySearch($query, $data);

        $questions = $this->paginate($query, $data['page'], 15);
        return QuestionResource::collection($questions);
    }

    /**
     * @return AnonymousResourceCollection
     */
    public function own(): AnonymousResourceCollection
    {
        $data = request()->validate([
            'search' => 'nullable|string',
            'page'   => 'required|int'
        ]);

        $query = Question::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc');

        $this->applySearch($query, $data);

        $questions = $this->paginate($query, $data['page'], 15);
        return QuestionResource::collection($questions);
    }

    /**
     * @return JsonResponse
     */
    public function store(): JsonResponse
    {
        $data = request()->validate([
            'question' => 'required|string|max:255'
        ]);

        try {
            Question::create([
                'user_id'  => Auth::id(),
                'question' => $data['question'],
                'search'   => $data['question']
            ]);
        } catch (Exception $exception) {
            return $this->exception($exception);
        }

        return $this->json(__('controllers.question.stored'));
    }

    /**
     * @param $query
     * @param array $data
     */
    protected function applySearch(&$query, array $data)
    {
        if (Arr::has($data, 'search')) {
            $searchFields = explode(' ', $data['search']);
            $query->where(static function ($query) use ($searchFields) {
                foreach ($searchFields as $searchField) {
                    $query->orWhere('search', 'like', '%' . $searchField . '%');
                }
            });
        }
    }
}
