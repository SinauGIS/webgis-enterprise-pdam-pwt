PGDMP     
                    }            gists    14.15 (Homebrew)    14.15 (Homebrew) F               0    0    ENCODING    ENCODING        SET client_encoding = 'UTF8';
                      false                       0    0 
   STDSTRINGS 
   STDSTRINGS     (   SET standard_conforming_strings = 'on';
                      false                       0    0 
   SEARCHPATH 
   SEARCHPATH     8   SELECT pg_catalog.set_config('search_path', '', false);
                      false                       1262    125415    gists    DATABASE     P   CREATE DATABASE gists WITH TEMPLATE = template0 ENCODING = 'UTF8' LOCALE = 'C';
    DROP DATABASE gists;
                unsorry    false                        2615    2200    public    SCHEMA        CREATE SCHEMA public;
    DROP SCHEMA public;
                unsorry    false                       0    0    SCHEMA public    COMMENT     6   COMMENT ON SCHEMA public IS 'standard public schema';
                   unsorry    false    4            �            1259    125450    cache    TABLE     �   CREATE TABLE public.cache (
    key character varying(255) NOT NULL,
    value text NOT NULL,
    expiration integer NOT NULL
);
    DROP TABLE public.cache;
       public         heap    unsorry    false    4            �            1259    125457    cache_locks    TABLE     �   CREATE TABLE public.cache_locks (
    key character varying(255) NOT NULL,
    owner character varying(255) NOT NULL,
    expiration integer NOT NULL
);
    DROP TABLE public.cache_locks;
       public         heap    unsorry    false    4            �            1259    125482    failed_jobs    TABLE     &  CREATE TABLE public.failed_jobs (
    id bigint NOT NULL,
    uuid character varying(255) NOT NULL,
    connection text NOT NULL,
    queue text NOT NULL,
    payload text NOT NULL,
    exception text NOT NULL,
    failed_at timestamp(0) without time zone DEFAULT CURRENT_TIMESTAMP NOT NULL
);
    DROP TABLE public.failed_jobs;
       public         heap    unsorry    false    4            �            1259    125481    failed_jobs_id_seq    SEQUENCE     {   CREATE SEQUENCE public.failed_jobs_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 )   DROP SEQUENCE public.failed_jobs_id_seq;
       public          unsorry    false    4    222                       0    0    failed_jobs_id_seq    SEQUENCE OWNED BY     I   ALTER SEQUENCE public.failed_jobs_id_seq OWNED BY public.failed_jobs.id;
          public          unsorry    false    221            �            1259    125474    job_batches    TABLE     d  CREATE TABLE public.job_batches (
    id character varying(255) NOT NULL,
    name character varying(255) NOT NULL,
    total_jobs integer NOT NULL,
    pending_jobs integer NOT NULL,
    failed_jobs integer NOT NULL,
    failed_job_ids text NOT NULL,
    options text,
    cancelled_at integer,
    created_at integer NOT NULL,
    finished_at integer
);
    DROP TABLE public.job_batches;
       public         heap    unsorry    false    4            �            1259    125465    jobs    TABLE     �   CREATE TABLE public.jobs (
    id bigint NOT NULL,
    queue character varying(255) NOT NULL,
    payload text NOT NULL,
    attempts smallint NOT NULL,
    reserved_at integer,
    available_at integer NOT NULL,
    created_at integer NOT NULL
);
    DROP TABLE public.jobs;
       public         heap    unsorry    false    4            �            1259    125464    jobs_id_seq    SEQUENCE     t   CREATE SEQUENCE public.jobs_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 "   DROP SEQUENCE public.jobs_id_seq;
       public          unsorry    false    4    219                       0    0    jobs_id_seq    SEQUENCE OWNED BY     ;   ALTER SEQUENCE public.jobs_id_seq OWNED BY public.jobs.id;
          public          unsorry    false    218            �            1259    125417 
   migrations    TABLE     �   CREATE TABLE public.migrations (
    id integer NOT NULL,
    migration character varying(255) NOT NULL,
    batch integer NOT NULL
);
    DROP TABLE public.migrations;
       public         heap    unsorry    false    4            �            1259    125416    migrations_id_seq    SEQUENCE     �   CREATE SEQUENCE public.migrations_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 (   DROP SEQUENCE public.migrations_id_seq;
       public          unsorry    false    4    211                       0    0    migrations_id_seq    SEQUENCE OWNED BY     G   ALTER SEQUENCE public.migrations_id_seq OWNED BY public.migrations.id;
          public          unsorry    false    210            �            1259    125434    password_reset_tokens    TABLE     �   CREATE TABLE public.password_reset_tokens (
    email character varying(255) NOT NULL,
    token character varying(255) NOT NULL,
    created_at timestamp(0) without time zone
);
 )   DROP TABLE public.password_reset_tokens;
       public         heap    unsorry    false    4            �            1259    126596    points    TABLE     8  CREATE TABLE public.points (
    id bigint NOT NULL,
    geom public.geometry NOT NULL,
    nama character varying(255) NOT NULL,
    alamat character varying(255) NOT NULL,
    status_pelanggan_id integer NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);
    DROP TABLE public.points;
       public         heap    unsorry    false    4    4    4    4    4    4    4    4    4    4    4    4    4    4    4    4    4            �            1259    126595    points_id_seq    SEQUENCE     v   CREATE SEQUENCE public.points_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 $   DROP SEQUENCE public.points_id_seq;
       public          unsorry    false    4    231                       0    0    points_id_seq    SEQUENCE OWNED BY     ?   ALTER SEQUENCE public.points_id_seq OWNED BY public.points.id;
          public          unsorry    false    230            �            1259    125441    sessions    TABLE     �   CREATE TABLE public.sessions (
    id character varying(255) NOT NULL,
    user_id bigint,
    ip_address character varying(45),
    user_agent text,
    payload text NOT NULL,
    last_activity integer NOT NULL
);
    DROP TABLE public.sessions;
       public         heap    unsorry    false    4            �            1259    125494    status_pelanggan    TABLE     �   CREATE TABLE public.status_pelanggan (
    id bigint NOT NULL,
    status character varying(255) NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);
 $   DROP TABLE public.status_pelanggan;
       public         heap    unsorry    false    4            �            1259    125493    status_pelanggan_id_seq    SEQUENCE     �   CREATE SEQUENCE public.status_pelanggan_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 .   DROP SEQUENCE public.status_pelanggan_id_seq;
       public          unsorry    false    4    224                       0    0    status_pelanggan_id_seq    SEQUENCE OWNED BY     S   ALTER SEQUENCE public.status_pelanggan_id_seq OWNED BY public.status_pelanggan.id;
          public          unsorry    false    223            �            1259    125424    users    TABLE     x  CREATE TABLE public.users (
    id bigint NOT NULL,
    name character varying(255) NOT NULL,
    email character varying(255) NOT NULL,
    email_verified_at timestamp(0) without time zone,
    password character varying(255) NOT NULL,
    remember_token character varying(100),
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);
    DROP TABLE public.users;
       public         heap    unsorry    false    4            �            1259    125423    users_id_seq    SEQUENCE     u   CREATE SEQUENCE public.users_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 #   DROP SEQUENCE public.users_id_seq;
       public          unsorry    false    4    213                       0    0    users_id_seq    SEQUENCE OWNED BY     =   ALTER SEQUENCE public.users_id_seq OWNED BY public.users.id;
          public          unsorry    false    212            H           2604    125485    failed_jobs id    DEFAULT     p   ALTER TABLE ONLY public.failed_jobs ALTER COLUMN id SET DEFAULT nextval('public.failed_jobs_id_seq'::regclass);
 =   ALTER TABLE public.failed_jobs ALTER COLUMN id DROP DEFAULT;
       public          unsorry    false    222    221    222            G           2604    125468    jobs id    DEFAULT     b   ALTER TABLE ONLY public.jobs ALTER COLUMN id SET DEFAULT nextval('public.jobs_id_seq'::regclass);
 6   ALTER TABLE public.jobs ALTER COLUMN id DROP DEFAULT;
       public          unsorry    false    218    219    219            E           2604    125420    migrations id    DEFAULT     n   ALTER TABLE ONLY public.migrations ALTER COLUMN id SET DEFAULT nextval('public.migrations_id_seq'::regclass);
 <   ALTER TABLE public.migrations ALTER COLUMN id DROP DEFAULT;
       public          unsorry    false    210    211    211            L           2604    126599 	   points id    DEFAULT     f   ALTER TABLE ONLY public.points ALTER COLUMN id SET DEFAULT nextval('public.points_id_seq'::regclass);
 8   ALTER TABLE public.points ALTER COLUMN id DROP DEFAULT;
       public          unsorry    false    230    231    231            J           2604    125497    status_pelanggan id    DEFAULT     z   ALTER TABLE ONLY public.status_pelanggan ALTER COLUMN id SET DEFAULT nextval('public.status_pelanggan_id_seq'::regclass);
 B   ALTER TABLE public.status_pelanggan ALTER COLUMN id DROP DEFAULT;
       public          unsorry    false    223    224    224            F           2604    125427    users id    DEFAULT     d   ALTER TABLE ONLY public.users ALTER COLUMN id SET DEFAULT nextval('public.users_id_seq'::regclass);
 7   ALTER TABLE public.users ALTER COLUMN id DROP DEFAULT;
       public          unsorry    false    212    213    213                      0    125450    cache 
   TABLE DATA           7   COPY public.cache (key, value, expiration) FROM stdin;
    public          unsorry    false    216   IO                 0    125457    cache_locks 
   TABLE DATA           =   COPY public.cache_locks (key, owner, expiration) FROM stdin;
    public          unsorry    false    217   fO       	          0    125482    failed_jobs 
   TABLE DATA           a   COPY public.failed_jobs (id, uuid, connection, queue, payload, exception, failed_at) FROM stdin;
    public          unsorry    false    222   �O                 0    125474    job_batches 
   TABLE DATA           �   COPY public.job_batches (id, name, total_jobs, pending_jobs, failed_jobs, failed_job_ids, options, cancelled_at, created_at, finished_at) FROM stdin;
    public          unsorry    false    220   �O                 0    125465    jobs 
   TABLE DATA           c   COPY public.jobs (id, queue, payload, attempts, reserved_at, available_at, created_at) FROM stdin;
    public          unsorry    false    219   �O       �          0    125417 
   migrations 
   TABLE DATA           :   COPY public.migrations (id, migration, batch) FROM stdin;
    public          unsorry    false    211   �O                 0    125434    password_reset_tokens 
   TABLE DATA           I   COPY public.password_reset_tokens (email, token, created_at) FROM stdin;
    public          unsorry    false    214   ^P                 0    126596    points 
   TABLE DATA           e   COPY public.points (id, geom, nama, alamat, status_pelanggan_id, created_at, updated_at) FROM stdin;
    public          unsorry    false    231   {P                 0    125441    sessions 
   TABLE DATA           _   COPY public.sessions (id, user_id, ip_address, user_agent, payload, last_activity) FROM stdin;
    public          unsorry    false    215   �P       D          0    125821    spatial_ref_sys 
   TABLE DATA           X   COPY public.spatial_ref_sys (srid, auth_name, auth_srid, srtext, proj4text) FROM stdin;
    public          unsorry    false    226   QR                 0    125494    status_pelanggan 
   TABLE DATA           N   COPY public.status_pelanggan (id, status, created_at, updated_at) FROM stdin;
    public          unsorry    false    224   nR                  0    125424    users 
   TABLE DATA           u   COPY public.users (id, name, email, email_verified_at, password, remember_token, created_at, updated_at) FROM stdin;
    public          unsorry    false    213   �R                  0    0    failed_jobs_id_seq    SEQUENCE SET     A   SELECT pg_catalog.setval('public.failed_jobs_id_seq', 1, false);
          public          unsorry    false    221                       0    0    jobs_id_seq    SEQUENCE SET     :   SELECT pg_catalog.setval('public.jobs_id_seq', 1, false);
          public          unsorry    false    218                       0    0    migrations_id_seq    SEQUENCE SET     ?   SELECT pg_catalog.setval('public.migrations_id_seq', 5, true);
          public          unsorry    false    210                       0    0    points_id_seq    SEQUENCE SET     ;   SELECT pg_catalog.setval('public.points_id_seq', 2, true);
          public          unsorry    false    230                       0    0    status_pelanggan_id_seq    SEQUENCE SET     E   SELECT pg_catalog.setval('public.status_pelanggan_id_seq', 2, true);
          public          unsorry    false    223                        0    0    users_id_seq    SEQUENCE SET     :   SELECT pg_catalog.setval('public.users_id_seq', 1, true);
          public          unsorry    false    212            \           2606    125463    cache_locks cache_locks_pkey 
   CONSTRAINT     [   ALTER TABLE ONLY public.cache_locks
    ADD CONSTRAINT cache_locks_pkey PRIMARY KEY (key);
 F   ALTER TABLE ONLY public.cache_locks DROP CONSTRAINT cache_locks_pkey;
       public            unsorry    false    217            Z           2606    125456    cache cache_pkey 
   CONSTRAINT     O   ALTER TABLE ONLY public.cache
    ADD CONSTRAINT cache_pkey PRIMARY KEY (key);
 :   ALTER TABLE ONLY public.cache DROP CONSTRAINT cache_pkey;
       public            unsorry    false    216            c           2606    125490    failed_jobs failed_jobs_pkey 
   CONSTRAINT     Z   ALTER TABLE ONLY public.failed_jobs
    ADD CONSTRAINT failed_jobs_pkey PRIMARY KEY (id);
 F   ALTER TABLE ONLY public.failed_jobs DROP CONSTRAINT failed_jobs_pkey;
       public            unsorry    false    222            e           2606    125492 #   failed_jobs failed_jobs_uuid_unique 
   CONSTRAINT     ^   ALTER TABLE ONLY public.failed_jobs
    ADD CONSTRAINT failed_jobs_uuid_unique UNIQUE (uuid);
 M   ALTER TABLE ONLY public.failed_jobs DROP CONSTRAINT failed_jobs_uuid_unique;
       public            unsorry    false    222            a           2606    125480    job_batches job_batches_pkey 
   CONSTRAINT     Z   ALTER TABLE ONLY public.job_batches
    ADD CONSTRAINT job_batches_pkey PRIMARY KEY (id);
 F   ALTER TABLE ONLY public.job_batches DROP CONSTRAINT job_batches_pkey;
       public            unsorry    false    220            ^           2606    125472    jobs jobs_pkey 
   CONSTRAINT     L   ALTER TABLE ONLY public.jobs
    ADD CONSTRAINT jobs_pkey PRIMARY KEY (id);
 8   ALTER TABLE ONLY public.jobs DROP CONSTRAINT jobs_pkey;
       public            unsorry    false    219            N           2606    125422    migrations migrations_pkey 
   CONSTRAINT     X   ALTER TABLE ONLY public.migrations
    ADD CONSTRAINT migrations_pkey PRIMARY KEY (id);
 D   ALTER TABLE ONLY public.migrations DROP CONSTRAINT migrations_pkey;
       public            unsorry    false    211            T           2606    125440 0   password_reset_tokens password_reset_tokens_pkey 
   CONSTRAINT     q   ALTER TABLE ONLY public.password_reset_tokens
    ADD CONSTRAINT password_reset_tokens_pkey PRIMARY KEY (email);
 Z   ALTER TABLE ONLY public.password_reset_tokens DROP CONSTRAINT password_reset_tokens_pkey;
       public            unsorry    false    214            k           2606    126603    points points_pkey 
   CONSTRAINT     P   ALTER TABLE ONLY public.points
    ADD CONSTRAINT points_pkey PRIMARY KEY (id);
 <   ALTER TABLE ONLY public.points DROP CONSTRAINT points_pkey;
       public            unsorry    false    231            W           2606    125447    sessions sessions_pkey 
   CONSTRAINT     T   ALTER TABLE ONLY public.sessions
    ADD CONSTRAINT sessions_pkey PRIMARY KEY (id);
 @   ALTER TABLE ONLY public.sessions DROP CONSTRAINT sessions_pkey;
       public            unsorry    false    215            g           2606    125499 &   status_pelanggan status_pelanggan_pkey 
   CONSTRAINT     d   ALTER TABLE ONLY public.status_pelanggan
    ADD CONSTRAINT status_pelanggan_pkey PRIMARY KEY (id);
 P   ALTER TABLE ONLY public.status_pelanggan DROP CONSTRAINT status_pelanggan_pkey;
       public            unsorry    false    224            P           2606    125433    users users_email_unique 
   CONSTRAINT     T   ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_email_unique UNIQUE (email);
 B   ALTER TABLE ONLY public.users DROP CONSTRAINT users_email_unique;
       public            unsorry    false    213            R           2606    125431    users users_pkey 
   CONSTRAINT     N   ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_pkey PRIMARY KEY (id);
 :   ALTER TABLE ONLY public.users DROP CONSTRAINT users_pkey;
       public            unsorry    false    213            _           1259    125473    jobs_queue_index    INDEX     B   CREATE INDEX jobs_queue_index ON public.jobs USING btree (queue);
 $   DROP INDEX public.jobs_queue_index;
       public            unsorry    false    219            U           1259    125449    sessions_last_activity_index    INDEX     Z   CREATE INDEX sessions_last_activity_index ON public.sessions USING btree (last_activity);
 0   DROP INDEX public.sessions_last_activity_index;
       public            unsorry    false    215            X           1259    125448    sessions_user_id_index    INDEX     N   CREATE INDEX sessions_user_id_index ON public.sessions USING btree (user_id);
 *   DROP INDEX public.sessions_user_id_index;
       public            unsorry    false    215            l           2606    126604 )   points points_status_pelanggan_id_foreign    FK CONSTRAINT     �   ALTER TABLE ONLY public.points
    ADD CONSTRAINT points_status_pelanggan_id_foreign FOREIGN KEY (status_pelanggan_id) REFERENCES public.status_pelanggan(id);
 S   ALTER TABLE ONLY public.points DROP CONSTRAINT points_status_pelanggan_id_foreign;
       public          unsorry    false    231    224    4455                  x������ � �            x������ � �      	      x������ � �            x������ � �            x������ � �      �   t   x�e��
�@���cB����A�"�h��7�)�D|��KI�=G�f�&{�-�k?[ ���Ưݰ~A.pZ���	����e<.v��]}ϲڬi4]��?CHwf]�䥽�O ?�AB            x������ � �         m   x�3�40B002p27u3v5�4q2u21�p27ts5234q22tq6�t�+��/����L)�Q�KI-��Q(-*��N-*��4�4202�50�52P00�25�24�&����� ^�C         I  x�5O�r�0]�Wd�n4����Oc
bA��R���R�|}Sm���y�{N(�U ô������s�����y��3�P��6��n�A���v�6/8e�T�k�����@� Hk���ސ���`�gG�1!�z��>��΃5֑T�T)rX;�� 5+A��2%!J����iz��%���X�A4k�����l"�,�8�&�����&|���L�
q�%�s�����+jN,�`5r�"��iߙ7ޕ���N����5x�&��؝�qW{�ނN�*����<{`}˻n�X�1����&a�������Bh��i���V����      D      x������ � �         (   x�3�t�.�L��".#N�Ĥ��Ԓ�"�X� �w	�          ~   x�3�t�+��/��LL���sH�M���K�����T1�T14R	�K��4�2O���Ɏ�t6�,rH��p��rK	)��-�t�4��4M���uL5�3�7202�50�5�T0��25�22�&����� 3�$�     