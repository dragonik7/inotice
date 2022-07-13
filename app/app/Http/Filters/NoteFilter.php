<?php


namespace App\Http\Filters;


use Illuminate\Database\Eloquent\Builder;

class NoteFilter extends AbstractFilter {
    public const TITLE = 'title';
    public const TAG_ID = 'tag_id';
    public const CREATED_AT = 'created_at';

    public function title(Builder $builder, $value) {
        $builder->where('title', 'ilike', "%$value%");
    }

    public function tagId(Builder $builder, $value) {
        $builder->where('tag_id', $value);
    }

    public function createdAt(Builder $builder, $value) {
        $builder->WhereBetween('created_at', $value);
    }

    protected function getCallbacks(): array {
        return [
            self::TITLE => [$this, 'title'],
            self::TAG_ID => [$this, 'tagId'],
            self::CREATED_AT => [$this, 'createdAt']
        ];
    }

}
