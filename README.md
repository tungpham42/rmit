# CRUD scaffolding — Roles, Semesters, Courses, Posts, Comments, Users

Blade + Tailwind + Alpine.js + SweetAlert2, all via CDN — no npm/yarn/vite needed.

## What's in here

```
app/Http/Controllers/         RoleController, SemesterController, CourseController,
                               PostController, CommentController, UserController
app/Http/Controllers/Auth/    LoginController, RegisterController
app/Models/                   your original model files (unchanged, included for reference)
resources/views/layouts/app.blade.php     sidebar layout for signed-in pages
resources/views/layouts/guest.blade.php   centered layout for login/register
resources/views/layouts/marketing.blade.php   public site layout (nav + footer)
resources/views/landing.blade.php         public landing page
resources/views/{resource}/               index, create, edit (+ _form partial where useful)
resources/views/auth/                     login.blade.php, register.blade.php
routes/marketing-web.php   the "/" route (landing page for guests, dashboard redirect for signed-in users)
routes/crud-web.php     admin CRUD routes (wrapped in "auth" middleware)
routes/auth-web.php     login/register/logout routes
```

## Install

1. Copy `app/Http/Controllers/*.php` (including the `Auth/` subfolder) into your
   project's `app/Http/Controllers/`.
2. Copy the `resources/views/*` folders into your project's `resources/views/`.
3. Paste the route files into `routes/web.php` in this order: `marketing-web.php`,
   then `auth-web.php`, then `crud-web.php`. The CRUD routes are already wrapped
   in `Route::middleware('auth')`; the landing page is public.
4. Make sure Laravel's pagination views are Tailwind-based (they are, by default, since
   Laravel 8+), so `{{ $roles->links() }}` etc. render correctly with the Tailwind CDN.
5. Nothing else to build — there's no asset compilation step, since Tailwind, Alpine,
   and SweetAlert2 all load from CDN in `layouts/app.blade.php` and `layouts/guest.blade.php`.

## Auth notes

- Login is by **email + password** (`email` / `password` field name). `User::getAuthPassword()`
  already points at your `password` column, so `Auth::attempt()` works unchanged.
- A deactivated account (`user_status = false`) is logged back out immediately with an error,
  even if the password was correct.
- New registrations are auto-assigned **the lowest `role_id`** as a default (typically your
  "least privileged" seeded role, e.g. student). Change the lookup in `RegisterController::register()`
  if you seed roles differently or want an explicit "Student" role by name instead.
- Registration logs the user in immediately (`user_status = true` on creation) — add an
  email-verification or admin-approval step here if you need one; it isn't included.
- No password-reset flow is included — say the word if you want forgot/reset-password added.

## Notes on scope

- Built for the **core entities**: Role, Semester, Course, Post, Comment, User.
- The pivot/interaction tables (`CommentVote`, `PostVote`, `PostRate`, `PostFollow`,
  `UserCourse`, `UserFollow`) were left out of the admin CRUD on purpose — in most apps
  like this they're written by "like/dislike/follow/enrol" actions on the Post/Course
  pages rather than managed as their own list-and-form screens. Say the word if you
  want simple CRUD screens for any of those too, or toggle-style routes instead
  (e.g. `POST /posts/{post}/vote`).

## Behaviour details worth knowing

- **Users**: password is hashed with `Hash::make()` on create; on edit, leaving the
  password field blank keeps the current password. A `user_hash` is auto-generated
  on create since it's not user-facing.
- **Semesters**: checking "current semester" automatically unmarks any other semester
  as current (only one can be current at a time).
- **Deletes**: Role/Course/User block deletion with a message if related records
  (users, posts, comments) still reference them; everything else deletes directly.
  All deletes go through a SweetAlert2 confirmation dialog before submitting.
- **Flash messages**: `session('success')` / `session('error')` are rendered as
  SweetAlert2 toasts automatically from the layout — just `return redirect()->with('success', '...')`
  from any controller.
- Route model binding relies on your models' custom primary keys (`role_id`,
  `post_id`, etc.), which Laravel picks up automatically since they're set via
  `protected $primaryKey` — no extra route binding config needed.
