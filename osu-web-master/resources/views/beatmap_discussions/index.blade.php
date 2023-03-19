{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
@php
    $statusOptions = App\Models\BeatmapDiscussion::VALID_BEATMAPSET_STATUSES;
    array_unshift($statusOptions, 'all');
@endphp

@extends('master')

{{-- FIXME: move to user modding history --}}
@section('content')
    @include('layout._page_header_v4', ['params' => ['theme' => 'beatmapsets']])
    <div class="osu-page osu-page--generic">
        <div class="beatmapset-activities">
            <h3>{{ osu_trans('beatmap_discussions.index.title') }}</h3>

            <form class="simple-form simple-form--search-box">
                <h2 class="simple-form__row simple-form__row--title">
                    {{ osu_trans('beatmap_discussions.index.form._') }}
                </h2>

                <label class="simple-form__row">
                    <div class="simple-form__label">
                        {{ osu_trans('beatmap_discussions.index.form.username') }}
                    </div>

                    <input
                        class="simple-form__input"
                        name="user"
                        value="{{ $search['user'] ?? '' }}"
                    >
                </label>

                <div class="simple-form__row">
                    <div class="simple-form__label">
                        {{ osu_trans('beatmap_discussions.index.form.beatmapset_status._') }}
                    </div>
                    <div class="simple-form__select">
                        <div class="form-select form-select--simple-form">
                            <select class="form-select__input" name="beatmapset_status">
                                @foreach ($statusOptions as $option)
                                    <option
                                        value="{{$option}}"
                                        {{ $option === $search['beatmapset_status'] ? "selected" : "" }}
                                    >
                                        {{ osu_trans("beatmap_discussions.index.form.beatmapset_status.{$option}") }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="simple-form__row">
                    <div class="simple-form__label">
                        {{ osu_trans('beatmap_discussions.index.form.mode') }}
                    </div>
                    <div class="simple-form__select">
                        <div class="form-select form-select--simple-form">
                            <select class="form-select__input" name="mode">
                                <option>
                                    {{ osu_trans('beatmaps.mode.all') }}
                                </option>
                                @foreach (App\Models\Beatmap::MODES as $modeStr => $modeInt)
                                    <option
                                        value="{{ $modeStr }}"
                                        {{ isset($search['mode']) && $modeStr === $search['mode'] ? "selected" : "" }}
                                    >
                                        {{ osu_trans("beatmaps.mode.{$modeStr}") }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="simple-form__row">
                    <div class="simple-form__label">
                        {{ osu_trans('beatmap_discussions.index.form.types') }}
                    </div>
                    <div class="simple-form__checkboxes-inline">
                        @php
                            $selectedMessageTypes = new Ds\Set($search['message_types']);
                        @endphp
                        @foreach (array_keys(App\Models\BeatmapDiscussion::MESSAGE_TYPES) as $messageType)
                            <label class="simple-form__checkbox simple-form__checkbox--inline">
                                @include('objects._switch', ['locals' => [
                                    'checked' => $selectedMessageTypes->contains($messageType),
                                    'name' => 'message_types[]',
                                    'value' => $messageType,
                                ]])
                                {{ osu_trans("beatmaps.discussions.message_type.{$messageType}") }}
                            </label>
                        @endforeach
                    </div>
                </div>

                <div class="simple-form__row simple-form__row--no-label">
                    <label class="simple-form__checkbox">
                        @include('objects._switch', ['locals' => [
                            'checked' => $search['only_unresolved'],
                            'name' => 'only_unresolved',
                        ]])
                        {{ osu_trans('beatmap_discussions.index.form.only_unresolved') }}
                    </label>
                </div>

                @if (priv_check('BeatmapDiscussionModerate')->can())
                    <div class="simple-form__row simple-form__row--no-label">
                        <label class="simple-form__checkbox">
                            @include('objects._switch', ['locals' => [
                                'checked' => $search['with_deleted'],
                                'name' => 'with_deleted',
                            ]])
                            {{ osu_trans('beatmap_discussions.index.form.deleted') }}
                        </label>
                    </div>
                @endif

                <div class="simple-form__row simple-form__row--no-label">
                    <button class="btn-osu-big btn-osu-big--rounded" type="submit">
                        <span class="btn-osu-big__content">
                            <span class="btn-osu-big__left">
                                {{ osu_trans('common.buttons.search') }}
                            </span>
                            <span class="btn-osu-big__icon btn-osu-big__icon--normal">
                                <i class="fas fa-search"></i>
                            </span>
                        </span>
                    </button>
                </div>
            </form>

            <div class="js-react--beatmap-discussions-history">
                <div class="beatmapset-activities__spinner">{!! spinner() !!}</div>
            </div>

            @include('objects._pagination_simple', ['object' => $paginator])
        </div>
    </div>
@endsection

@section ("script")
    @parent

    <script id="json-index" type="application/json">
        {!! json_encode($json) !!}
    </script>

    @include('layout._react_js', ['src' => 'js/beatmap-discussions-history.js'])
@endsection
