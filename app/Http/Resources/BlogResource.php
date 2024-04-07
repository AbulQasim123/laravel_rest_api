<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BlogResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    // public function toArray($request)
    // {
    //     return parent::toArray($request);
    // }

    public function getBlogDetail(): array
    {
        return [
            'blogId' => $this->id,
            'blogTitle' => $this->title,
            'blogShortDescription' => $this->short_description,
            'blogLongDescription' => $this->long_description,
            'bLogCommentsCount' => $this->comments_count,
            'blogLikesCount' => $this->likes_count,
            'liked_by_current_user' => $this->liked_by_current_user,
            'BlogImageUrl' => $this->image_url,
            'human_readable_created_at' => $this->human_readable_created_at,
            'userId' => $this->user->id,
            'userName' => $this->user->name,
            'userEmail' => $this->user->email,
            'userProfession' => $this->user->profession,
            'profileImageUrl' => $this->user->profile_image_url,
            'categoryId' => $this->category->id,
            'categoryName' => $this->category->name,
            'categoryIsActive' => $this->category->is_active,
        ];
    }
}
