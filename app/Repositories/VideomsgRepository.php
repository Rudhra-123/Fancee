<?php
namespace App\Repositories;
use App\Contracts\Repositories\VideomsgRepositoryInterface;
use App\Models\Videomsg;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

class VideomsgRepository implements VideomsgRepositoryInterface
{
    public function __construct(
        private readonly Videomsg $videomsg,
    )
    {
    }

    public function add(array $data): string|object
    {
        return $this->videomsg->create($data);
    }

    public function getFirstWhere(array $params, array $relations = []): ?Model
    {
        return $this->videomsg->withoutGlobalScope('translate')->where($params)->with($relations)->first();
    }

    public function getList(array $orderBy = [], array $relations = [], int|string $dataLimit = DEFAULT_DATA_LIMIT, int $offset = null): Collection|LengthAwarePaginator
    {
        $query = $this->videomsg->with($relations)
            ->when(!empty($orderBy), function ($query) use ($orderBy) {
                $query->orderBy(array_key_first($orderBy), array_values($orderBy)[0]);
            });
        return $dataLimit == 'all' ? $query->get() : $query->paginate($dataLimit);
    }

    public function getListWhere(
        array      $orderBy = [],
        string     $searchValue = null,
        array      $filters = [], 
        array      $relations = [],
        int|string $dataLimit = DEFAULT_DATA_LIMIT,
        int        $offset = null): Collection|LengthAwarePaginator
    {
        $query = $this->videomsg->when($searchValue, function ($query) use ($searchValue) {
                    return $query->where('message', 'like', "%$searchValue%");
                })
                ->when(!empty($orderBy), function ($query) use ($orderBy) {
                    $query->orderBy(array_key_first($orderBy), array_values($orderBy)[0]);
                });

        $filters += ['searchValue' => $searchValue];
        return $dataLimit == 'all' ? $query->get() : $query->paginate($dataLimit)->appends($filters);
    }

    public function update(string $id, array $data): bool
    {
        return $this->videomsg->where('id', $id)->update($data);
    }

    public function delete(array $params): bool
    {
        $this->videomsg->where($params)->delete();
        return true;
    }
}