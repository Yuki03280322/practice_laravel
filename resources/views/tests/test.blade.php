Hello World!!<br>

@foreach($values as $value)
{{$value->id}}<br>
{{$value->text}}<br>
@endforeach
{{-- 
bladeはlaravelのテンプレートエンジンであり、viewの中にPHPを直接記述することが可能
{{ }}記法はXSS攻撃を防ぐため自動的にPHPのhtmlspecialchars関数を通される
bladeのメリットはレイアウト拡張と継承が可能な点
  --}}
